<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

// Landing Page - hiển thị nút đăng nhập
Route::get('/landingpage', function () {
    return view('landingpage');
})->name('landingpage');

// // Dashboard - hiển thị nút đăng nhập
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// // Routes cho đăng nhập
// Route::get('/auth/redirect', [AuthController::class, 'redirectToCognito'])->name('auth.redirect');
// Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
// Route::get('/auth/signup', [AuthController::class, 'redirectToSignup'])->name('auth.signup');
// Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');
// Route::get('/auth/forgot', [AuthController::class, 'forgotPassword'])->name('auth.forgot');
// Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => ['web']], function () {
    // Route xác thực
    Route::get('/auth/redirect', [AuthController::class, 'redirectToCognito'])->name('auth.redirect');
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/signup', [AuthController::class, 'redirectToSignup'])->name('auth.signup');
    Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');
    Route::get('/auth/forgot', [AuthController::class, 'forgotPassword'])->name('auth.forgot');
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Route dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

    //Routes cho Cycle
    Route::resource('cycles', CycleController::class);

    // Routes cho Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// //Routes cho Cycle
// Route::resource('cycles', CycleController::class);

// // Routes cho Profile
// Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
// Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');