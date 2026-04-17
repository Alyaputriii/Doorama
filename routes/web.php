<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// FORGOT PASSWORD
Route::get('/forgot-password', function () {
    return view('lupa-password');
})->name('password.request');

Route::post('/forgot-password', function () {
    return redirect()->route('password.reset');
});

// RESET PASSWORD
Route::get('/reset-password', function () {
    return view('reset-password');
})->name('password.reset');

Route::post('/reset-password', function () {
    return redirect()->route('login')->with('success', 'Password berhasil direset!');
});

// PROTECTED
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/status', function () {
        return view('status');
    })->name('status');

    Route::get('/pengaturan', function () {
        return view('pengaturan', [
            'knocks' => 6,
            'status' => 'Online'
        ]);
    })->name('pengaturan');

    Route::get('/pengaturan/edit', function () {
        return view('edit-pengaturan');
    })->name('pengaturan.edit');

});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');