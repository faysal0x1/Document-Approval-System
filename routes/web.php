<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkflowController;
use App\Http\Controllers\WorkflowStepController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', [DashboardRedirectController::class, 'index'])->name('dashboard');

    // Documents
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents/show-form', [DocumentController::class, 'showForm'])->name('documents.showForm');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/submitted/{document}', [DocumentController::class, 'submitted'])->name('documents.submitted');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');

    // Approvals
    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::get('/approvals/{approval}', [ApprovalController::class, 'show'])->name('approvals.show');
    Route::post('/approvals/{approval}/approve', [ApprovalController::class, 'approve'])->name('approvals.approve');
    Route::post('/approvals/{approval}/reject', [ApprovalController::class, 'reject'])->name('approvals.reject');

    defineRoleBasedRoutes(function () {
        Route::resource('user', UserController::class);

        // Admin routes
        Route::resource('document-types', DocumentTypeController::class);
        Route::resource('workflows', WorkflowController::class)->except(['show']);

        Route::put('steps/{step}', [WorkflowController::class, 'updateStep']);
        Route::delete('steps/{step}', [WorkflowController::class, 'deleteStep'])
            ->name('steps.delete');

        Route::prefix('workflows/{workflow}')->as('workflows.')->group(function () {
            Route::resource('steps', WorkflowStepController::class)->except(['show']);

            Route::post('/steps', [WorkflowController::class, 'addStep'])
                ->name('steps.add');

        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/user.php';
require __DIR__.'/admin.php';
