<?php

namespace App\Providers;

use App\Interfaces\ApproverResolverInterface;
use App\Models\Permission;
use App\Models\Role;
use App\Observers\PermissionObserver;
use App\Observers\RoleObserver;
use App\Services\ApproverResolvers\RoleBasedApproverResolver;
use App\Services\DepartmentBasedApproverResolver;
use App\Services\WorkflowEngine;
use App\Services\WorkflowStepHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApproverResolverInterface::class, function ($app, $params) {
            $type = $params['type'] ?? 'role';

            return $type === 'department'
                ? new DepartmentBasedApproverResolver
                : new RoleBasedApproverResolver;
        });

        $this->app->singleton(WorkflowStepHandler::class);
        $this->app->singleton(WorkflowEngine::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Permission::observe(PermissionObserver::class);
        Role::observe(RoleObserver::class);

    }
}
