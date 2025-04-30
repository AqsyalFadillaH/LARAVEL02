<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('login');
})->name('login.page');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute Verifikasi
Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
    ->name('verification.notice');
Route::get('/email/verify/send', [EmailVerificationController::class, 'send'])
    ->name('verification.send');
Route::post('/email/verify', [EmailVerificationController::class, 'verify'])
    ->name('verification.verify');

// Rute yang Memerlukan Autentikasi dan Verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profiles', [ProfilesController::class, 'show'])->name('profiles.show');
    Route::post('/profiles', [ProfilesController::class, 'update'])->name('profiles.update');
    Route::get('/profiles/current', [ProfilesController::class, 'getCurrentProfiles'])->name('profiles.current');
});
