<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['module:user'])->group(function () {
    defineRoleBasedRoutes(function () {
        Route::resource('user', UserController::class);
        route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');
    });
});
