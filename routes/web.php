<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// api for Web
Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('login', function () {
    return Inertia::render('Auth/Login');
});

Route::get('register', function () {
    return Inertia::render('Auth/Register');
});

Route::middleware('auth')->group(function () {

});

require __DIR__.'/auth.php';
