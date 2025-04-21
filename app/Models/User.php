<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, LaratrustUser
{
    use HasFactory, HasRolesAndPermissions,
        Notifiable;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'address',
        'email_verified_at',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'user_stores', 'user_id', 'store_id')
            ->where('status', 1)
            ->where('company_id', $this->company_id)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        // Include roles and permissions in JWT token for faster access
        return [
            //            'roles' => $this->roles()->pluck('name')->toArray(),
            'email' => $this->email,
            //            'phone' => $this->phone,
            //            'permissions' => $this->allPermissions()->pluck('name')->toArray(),
        ];
    }
}
