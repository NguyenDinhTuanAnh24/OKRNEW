<?php

use App\Http\Controllers\TeamOkrController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeyResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

// Landing Page - hiển thị nút đăng nhập
Route::get('/landingpage', function () {
    return view('landingpage');
})->name('landingpage');

// Dashboard - hiển thị nút đăng nhập
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Trang đăng nhập/đăng ký mới
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
Route::get('/auth/signup', [AuthController::class, 'redirectToSignup'])->name('auth.signup');
Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');
Route::get('/auth/forgot', [AuthController::class, 'forgotPassword'])->name('auth.forgot');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
