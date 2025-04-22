<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/**
 * @return void
 */
defineRoleBasedRoutes(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
});

Route::get('/toggle-status/{model}/{id}', [AdminController::class, 'toggleStatus'])
    ->name('toggleStatus');

Route::post('/file-upload', [FileUploadController::class, 'upload'])->name('file.upload');

Route::prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('mark-all-read');
    Route::post('/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
});
