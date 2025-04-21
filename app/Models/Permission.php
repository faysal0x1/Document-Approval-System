<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    public $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id;
        });
    }

    /**
     * Many-to-Many relations with Role.
     */
    public function roles(): BelongsToMany
    {
        return parent::roles();
    }

    /**
     * Many-to-Many relations with Team.
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(
            config('laratrust.models.team'),
            config('laratrust.tables.permission_team'),
            config('laratrust.foreign_keys.permission'),
            config('laratrust.foreign_keys.team')
        );
    }
}
