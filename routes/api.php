<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScholarshipApplicationController;
use App\Http\Controllers\ScholarshipProgramController;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/register', [AuthController::class, 'apiRegister']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'apiLogout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/scholarship-programs/open', [ScholarshipProgramController::class, 'openPrograms']);
    Route::get('/scholarship-programs', [ScholarshipProgramController::class, 'index']);
    Route::get('/scholarship-programs/{id}', [ScholarshipProgramController::class, 'show']);

    Route::middleware('role:student')->group(function () {
        Route::get('/student/applications', [ScholarshipApplicationController::class, 'index']);
        Route::post('/student/applications', [ScholarshipApplicationController::class, 'store']);
        Route::post('/scholarship/apply', [ScholarshipApplicationController::class, 'store']);
        Route::get('/student/applications/{id}', [ScholarshipApplicationController::class, 'show']);
        Route::put('/student/applications/{id}', [ScholarshipApplicationController::class, 'update']);
        Route::delete('/student/applications/{id}', [ScholarshipApplicationController::class, 'destroy']);
    });

    Route::middleware('role:secretary,admin')->group(function () {
        Route::get('/secretary/applications', [ScholarshipApplicationController::class, 'indexAll']);
        Route::get('/applications', [ScholarshipApplicationController::class, 'indexAll']);
        Route::patch('/secretary/applications/{id}/status', [ScholarshipApplicationController::class, 'updateStatus']);
        Route::patch('/applications/{id}/status', [ScholarshipApplicationController::class, 'updateStatus']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class)->except(['create', 'edit']);
        Route::get('/admin/scholarship-applications', [ScholarshipApplicationController::class, 'indexAll']);
        Route::get('/admin/records', [ScholarshipApplicationController::class, 'indexAll']);
        Route::patch('/admin/scholarship-applications/{id}/status', [ScholarshipApplicationController::class, 'updateStatus']);
        Route::put('/admin/scholarship-applications/{id}', [ScholarshipApplicationController::class, 'update']);
        Route::delete('/admin/scholarship-applications/{id}', [ScholarshipApplicationController::class, 'destroy']);
    });
});
