<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/**
 * @return void
 */
defineRoleBasedRoutes(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('projects', ProjectController::class);
    Route::get('/user/details/{id}', [UserController::class, 'getUserDetails'])->name('user.details');

});

Route::get('/toggle-status/{model}/{id}', [AdminController::class, 'toggleStatus'])
    ->name('toggleStatus');

Route::patch('projects/{project}/update-status', [ProjectController::class, 'updateStatus'])
    ->name('projects.update-status');

Route::post('/file-upload', [FileUploadController::class, 'upload'])->name('file.upload');

Route::get('/get/products', [AdminController::class, 'getProducts'])
    ->name('get.products');

Route::get('/users/{user}/stores', [UserController::class, 'getUserStores'])
    ->name('users.get-stores');
Route::post('/users/{user}/assign-stores', [UserController::class, 'assignStores'])
    ->name('users.assign-stores');
