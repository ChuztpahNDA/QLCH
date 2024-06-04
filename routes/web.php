<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__ . '/auth.php';


// api for Web
Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
});

Route::get('/home', function () {
    return Inertia::render('Home');
});

Route::get('/products', function () {
    return Inertia::render('Home');
});

Route::get('/stores', function () {
    return Inertia::render('Home');
});

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

// api response data
Route::prefix('api/v1')->group(function () {

    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware([ApiAuthMiddleware::class])->group(function () {
        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // refresh access token
        Route::post('refresh-token', [AuthController::class, 'refreshToken'])->name('refreshToken');
        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
    });
});
