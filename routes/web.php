<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserJourneyController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/journey', [UserJourneyController::class, 'index'])->name('user.journey');
    Route::get('/journey/step/{step}', [UserJourneyController::class, 'step'])->name('journey.step');
    Route::post('/journey/step/{step}', [UserJourneyController::class, 'processStep']);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'adminLogin']);
    });
    
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        
        Route::resource('categories', CategoryController::class);
        Route::resource('gifts', GiftController::class);
        Route::resource('users', UserController::class);
    });
});