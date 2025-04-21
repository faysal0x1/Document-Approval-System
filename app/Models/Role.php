<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
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
     * Many-to-Many relations with Team.
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(
            config('laratrust.models.team'),
            config('laratrust.tables.role_team'),
            config('laratrust.foreign_keys.role'),
            config('laratrust.foreign_keys.team')
        );
    }

    // On creating or Updating Add created by and updated by

    /**
     * Many-to-Many relations with Permission.
     */
    public function permissions(): BelongsToMany
    {
        return parent::permissions();
    }
}
