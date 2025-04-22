<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Only add the composer to layouts and views that need sidebar data
        View::composer(['layouts.admin', 'admin.partials.sidebar'], function ($view) {
            static $sidebarData = null;

            if ($sidebarData === null) {
                $sidebarData = [
                    'pendingApprovalsCount' => 0,
                    'pendingDocumentsCount' => 0,
                    'notificationsCount' => 0,
                    'notifications' => [],
                ];

                if (Auth::check()) {
                    $userId = Auth::id();
                    $user = User::withCount([
                        'approvals as pending_approvals_count' => function ($query) {
                            $query->where('status', 'pending');
                        },
                        'documents as pending_documents_count' => function ($query) {
                            $query->where('status', 'pending');
                        },
                    ])->find($userId);

                    if ($user) {
                        $notificationsCount = $user->unreadNotifications()->count();
                        $notifications = $user->notifications()->latest()->limit(5)->get();
                        $sidebarData = [
                            'pendingApprovalsCount' => $user->pending_approvals_count,
                            'pendingDocumentsCount' => $user->pending_documents_count,
                            'notificationsCount' => $notificationsCount,
                            'notifications' => $notifications,
                        ];
                    }
                }
            }

            $view->with($sidebarData);
        });
    }
}
