<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\Company;
use App\Models\CompanyModule;
use App\Models\Module;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string', 'max:255'],
            'company_email' => ['required', 'string', 'email', 'max:255', 'unique:companies,email'],
            'company_phone' => ['nullable', 'string', 'unique:companies,phone'],
            'company_website' => ['nullable', 'url'],
            'company_address' => ['nullable', 'string'],
            'company_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'company_currency' => ['required', 'string'],
            'company_timezone' => ['required', 'string'],
            'date_format' => ['required', 'in:d/m/Y,m/d/Y,Y/m/d'],
            'time_format' => ['required', 'in:12,24'],
            'first_day_of_week' => ['required', 'in:0,1,2,3,4,5,6'],

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'unique:users'],
            'address' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:20048'],
            'role' => ['required', 'in:admin,manager,hr-manager,finance-manager,accountant,auditor,cashier,sales-executive,store-manager,storekeeper,purchasing-officer,employee'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'modules' => ['required', 'array', 'min:1'],
            'modules.*' => ['exists:modules,id'],
            'terms_accepted' => ['required', 'accepted'],
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            // Handle company logo upload
            $logoPath = null;
            if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
                $logoPath = $request->file('company_logo')->store('company-logos', 'public');
            }

            // Create company record
            $company = Company::create([
                'name' => $request->company_name,
                'email' => $request->company_email,
                'phone' => $request->company_phone,
                'website' => $request->company_website,
                'address' => $request->company_address,
                'logo' => $logoPath,
                'currency' => $request->company_currency,
                'timezone' => $request->company_timezone,
                'date_format' => $request->date_format,
                'time_format' => $request->time_format,
                'first_day_of_week' => $request->first_day_of_week,
                'status' => 1,
                'is_subscribed' => 1,
            ]);

            // Handle user photo upload
            $photoPath = null;
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $photoPath = $request->file('photo')->store('user-photos', 'public');
            }

            // Create user record
            $user = User::create([
                'company_id' => $company->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $photoPath,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 1,
                'is_subscribed' => $request->has('is_subscribed') ? 1 : 0,
                'created_by' => null, // First user has no creator
            ]);

            // Update the company's created_by field with the new user
            $company->created_by = $user->id;
            $company->save();

            // Assign modules to company
            $moduleData = [];
            foreach ($request->modules as $moduleId) {
                $moduleData[] = [
                    'company_id' => $company->id,
                    'module_id' => $moduleId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            CompanyModule::insert($moduleData);

            // Get module details for email
            $selectedModules = Module::whereIn('id', $request->modules)->get();

            // Send welcome email
            Mail::to($user->email)->send(new WelcomeEmail($user, $company, $selectedModules));

            DB::commit();

            $user->addRole('admin');

            event(new Registered($user));

            auth()->login($user);

            return redirect(route('dashboard', absolute: false));
        } catch (Exception $e) {
            DB::rollback();

            // Clean up any uploaded files in case of failure
            if (isset($logoPath) && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }

            if (isset($photoPath) && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            return back()->withErrors(['error' => 'Registration failed: '.$e->getMessage()])->withInput();
        }
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $modules = Module::all();

        return view('auth.register', compact('modules'));
    }
}
