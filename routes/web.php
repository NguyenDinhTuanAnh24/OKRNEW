<?php
use App\Http\Controllers\AuthController;

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Trang đăng nhập
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

// Trang đăng ký
Route::get('/register', function () {
    return view('auth.register');
})->name('auth.register');

// Routes cho đăng nhập
Route::get('/auth/redirect', [AuthController::class, 'redirectToCognito'])->name('auth.redirect');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');

// Routes cho đăng ký
Route::get('/auth/signup', [AuthController::class, 'redirectToSignup'])->name('auth.signup');

// Callback routes
Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');
Route::get('/auth/google-callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Other routes
Route::get('/auth/forgot', [AuthController::class, 'forgotPassword'])->name('auth.forgot');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
