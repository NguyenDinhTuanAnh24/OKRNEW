<?php
use App\Http\Controllers\AuthController;

// Dashboard - hiển thị nút đăng nhập
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Routes cho đăng nhập
Route::get('/auth/redirect', [AuthController::class, 'redirectToCognito'])->name('auth.redirect');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');
Route::get('/auth/forgot', [AuthController::class, 'forgotPassword'])->name('auth.forgot');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
