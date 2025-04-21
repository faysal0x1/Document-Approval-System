<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('documents', DocumentController::class)->only(['store']);
    Route::prefix('approvals')->group(function () {
        Route::post('/{approval}/approve', [ApprovalController::class, 'approve']);
        Route::post('/{approval}/reject', [ApprovalController::class, 'reject']);
    });
});
