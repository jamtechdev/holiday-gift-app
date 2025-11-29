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

// Public authentication routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.submit');

// User routes - prefixed with 'user' and named with 'user.*'
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/journey', [UserJourneyController::class, 'index'])->name('journey');
        Route::get('/gift-categories', [UserJourneyController::class, 'giftCategories'])->name('gift.categories');
        Route::get('/gifts/category/{category}', [UserJourneyController::class, 'showGiftsByCategory'])->name('gifts.byCategory');
        Route::get('/claimed', [UserJourneyController::class, 'claimed'])->name('claimed');

        Route::get('/gift-request', [GiftRequestController::class, 'create'])->name('gift-request.create');
        Route::post('/gift-request', [GiftRequestController::class, 'store'])->name('gift-request.store');
    });
});

// Admin routes - prefixed with 'admin' and named with 'admin.*'
// Protected by 'role:admin' middleware to prevent regular users from accessing
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login routes - public, authentication check handled in controller
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.submit');

    // Admin protected routes - require authentication and admin role
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('gifts', GiftController::class);
        Route::resource('users', UserController::class);

        Route::get('/gift-requests', [UserGiftRequestController::class, 'index'])->name('gift-requests.index');
        Route::get('/gift-requests-export', [UserGiftRequestController::class, 'export'])->name('gift-requests.export');
        Route::get('/gift-requests/{userGiftRequest}', [UserGiftRequestController::class, 'show'])->name('gift-requests.show');
        Route::delete('/gift-requests/{userGiftRequest}', [UserGiftRequestController::class, 'destroy'])->name('gift-requests.destroy');

        Route::get('/users-export', [UserController::class, 'export'])->name('users.export');
        Route::post('/users-import', [UserController::class, 'importStore'])->name('users.import.store');
    });
});
