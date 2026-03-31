<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showAuthPage'])->name('login');
Route::get('/login', [AuthController::class, 'showAuthPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// role-specific quick endpoints
Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::get('/secretary', function () {
    return view('dashboard');
})->middleware(['auth', 'role:secretary'])->name('secretary.dashboard');
