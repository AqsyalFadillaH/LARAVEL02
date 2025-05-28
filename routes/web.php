<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\JadwalController;

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
    // Role-based Dashboard Route
    Route::get('/admin/dashboard', function () {
    $user = auth()->user();
    \Log::info('Rendering dashboardadmin for admin');
    return view('dashboardadmin');
})->name('admin.dashboard');

    Route::get('/profiles', [ProfilesController::class, 'show'])->name('profiles.show');
    Route::post('/profiles', [ProfilesController::class, 'update'])->name('profiles.update');
    Route::get('/profiles/current', [ProfilesController::class, 'getCurrentProfiles'])->name('profiles.current');
});

Route::get('/dosen/dashboard', function () {
    $user = auth()->user();
    \Log::info('Rendering dashboarddosen for admin');
    return view('dashboarddosen');
})->name('dosen.dashboard');
// Rute sidebar akademik
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');