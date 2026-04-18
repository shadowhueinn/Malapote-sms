<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json(['message' => 'No web interface is available. Use the JSON API endpoints instead.'], 404);
});

