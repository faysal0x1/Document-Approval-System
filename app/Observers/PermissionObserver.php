<?php

namespace App\Observers;

use App\Models\Permission;
use App\Services\PermissionCacheService;

class PermissionObserver
{
    protected $cacheService;

    public function __construct(PermissionCacheService $cacheService)
    {
        //        $this->cacheService = $cacheService;
    }

    public function created(Permission $permission)
    {
        //        $this->cacheService->clearAllCache();
    }

    public function updated(Permission $permission)
    {
        //        $this->cacheService->clearAllCache();
    }

    public function deleted(Permission $permission)
    {
        //        $this->cacheService->clearAllCache();
    }
}
