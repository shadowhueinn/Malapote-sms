<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipProgramController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RequirementController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Scholarship Programs
Route::apiResource('scholarship-programs', ScholarshipProgramController::class);

// Applicants
Route::apiResource('applicants', ApplicantController::class);

// Applications
Route::apiResource('applications', ApplicationController::class);

// Update Application Status
Route::patch('applications/{id}/status', [ApplicationController::class, 'updateStatus']);

// Requirements
Route::apiResource('requirements', RequirementController::class);