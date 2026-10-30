<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HunianController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// Login, register, logout
Route::get('/login', fn () => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lupa password (tanpa email)
Route::get('/lupa-password', [PasswordResetController::class, 'show'])->name('password.request');
Route::post('/lupa-password', [PasswordResetController::class, 'update'])
    ->middleware('throttle:5,1')
    ->name('password.update');

// Hanya Penyewa
Route::middleware(['auth', 'role:Penyewa'])->group(function () {
    Route::get('/cari-hunian', [HunianController::class, 'index'])->name('cari-hunian');
    Route::get('/hunian/{property}', [HunianController::class, 'show'])->name('detail');
});

// Hanya Pemilik
Route::middleware(['auth', 'role:Pemilik'])->group(function () {
    Route::get('/pengguna', [PropertyController::class, 'index'])->name('pengguna');
    Route::post('/properti', [PropertyController::class, 'store'])->name('properti.store');
    Route::put('/properti/{property}', [PropertyController::class, 'update'])->name('properti.update');
    Route::delete('/properti/{property}', [PropertyController::class, 'destroy'])->name('properti.destroy');

    Route::get('/kamar', [RoomController::class, 'index'])->name('kamar');
    Route::post('/kamar', [RoomController::class, 'store'])->name('kamar.store');
    Route::put('/kamar/{room}', [RoomController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{room}', [RoomController::class, 'destroy'])->name('kamar.destroy');
});

// Hanya Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::delete('/admin/pengguna/{user}', [AdminController::class, 'destroy'])->name('admin.pengguna.destroy');
});