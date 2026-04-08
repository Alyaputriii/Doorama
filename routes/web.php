<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login'); // redirect ke /login
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function () {
    return "Login berhasil 🔐";
});