<?php

namespace App\Observers;

use App\Models\Role;
use App\Services\PermissionCacheService;

class RoleObserver
{
    protected $cacheService;

    public function __construct(PermissionCacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function created(Role $role)
    {
        //        $this->cacheService->clearAllCache();
    }

    public function updated(Role $role)
    {
        //        $this->cacheService->clearAllCache();
    }

    public function deleted(Role $role)
    {
        //        $this->cacheService->clearAllCache();
    }
}
