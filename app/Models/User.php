<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [
            //            'roles' => $this->roles()->pluck('name')->toArray(),
            'email' => $this->email,
            //            'phone' => $this->phone,
            //            'permissions' => $this->allPermissions()->pluck('name')->toArray(),
        ];
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'submitter_id');
    }

    /**
     * Relationship: Approvals assigned to this user
     */
    public function approvals()
    {
        return $this->hasMany(Approval::class, 'approver_id');
    }

    /**
     * Relationship: User's roles (for role-based approval)
     */
    //    public function roles(){
    //        return $this->belongsToMany(Role::class);
    //    }

    /**
     * Relationship: User's department (for department-based approval)
     */
    //    public function department(): BelongsTo
    //    {
    //        return $this->belongsTo(Department::class);
    //    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'supervisor_id');
    }

    /**
     * Relationship: Users who report to this user (inverse of supervisor)
     */
    public function subordinates(): HasMany
    {
        return $this->hasMany(__CLASS__, 'supervisor_id');
    }

    /**
     * Check if user has a specific role
     */
    //    public function hasRole($roleName): bool
    //    {
    //        return $this->roles()->where('name', $roleName)->exists();
    //    }

    public function pendingApprovals(): HasMany
    {
        return $this->approvals()->where('status', 'pending');
    }
}
