<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilesController;

Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profiles', [ProfilesController::class, 'show'])->name('profiles.show');
    Route::post('/profiles', [ProfilesController::class, 'update'])->name('profiles.update');
    Route::get('/profiles/current', [ProfilesController::class, 'getCurrentProfiles'])->name('profiles.current');
});