<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserJourneyController;
use App\Http\Controllers\GiftRequestController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserGiftRequestController;
use Illuminate\Support\Facades\Route;

// Login routes - authentication check handled in controller
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/journey', [UserJourneyController::class, 'index'])->name('user.journey');
    Route::get('/journey/step/{step}', [UserJourneyController::class, 'step'])->name('journey.step');
    Route::post('/journey/step/{step}', [UserJourneyController::class, 'processStep']);
});

Route::get('/gift-request', [GiftRequestController::class, 'create'])->name('gift-request.create');
Route::post('/gift-request', [GiftRequestController::class, 'store'])->name('gift-request.store');
Route::get('/gift-request/success', [GiftRequestController::class, 'success'])->name('gift-request.success');

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login routes - authentication check handled in controller
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'adminLogin']);
    
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        
        Route::resource('categories', CategoryController::class);
        Route::resource('gifts', GiftController::class);
        Route::resource('users', UserController::class);
        
        Route::get('/gift-requests', [UserGiftRequestController::class, 'index'])->name('gift-requests.index');
        Route::get('/gift-requests/{userGiftRequest}', [UserGiftRequestController::class, 'show'])->name('gift-requests.show');
        Route::patch('/gift-requests/{userGiftRequest}/status', [UserGiftRequestController::class, 'updateStatus'])->name('gift-requests.update-status');
        Route::delete('/gift-requests/{userGiftRequest}', [UserGiftRequestController::class, 'destroy'])->name('gift-requests.destroy');
        
        Route::get('/users-export', [UserController::class, 'export'])->name('users.export');
        Route::post('/users-import', [UserController::class, 'importStore'])->name('users.import.store');
    });
});