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
        Route::get('/already-claimed', [UserJourneyController::class, 'alreadyClaimed'])->name('already.claimed');

        Route::post('/gift-request', [GiftRequestController::class, 'store'])->name('gift-request.store');
    });
});

// Demo routes - prefixed with '2025season' for demo site
// These routes bypass site-closed check and are completely separate
Route::prefix('2025season')->name('demo.')->middleware('demo')->group(function () {
    // Demo login routes - public
    Route::get('/', [\App\Http\Controllers\Demo\AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [\App\Http\Controllers\Demo\AuthController::class, 'login'])->name('login.submit');

    // Demo user routes - require authentication
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Demo\AuthController::class, 'logout'])->name('logout');

        Route::get('/journey', [\App\Http\Controllers\Demo\UserJourneyController::class, 'index'])->name('journey');
        Route::get('/gift-categories', [\App\Http\Controllers\Demo\UserJourneyController::class, 'giftCategories'])->name('gift.categories');
        Route::get('/gifts/category/{category}', [\App\Http\Controllers\Demo\UserJourneyController::class, 'showGiftsByCategory'])->name('gifts.byCategory');
        Route::get('/claimed', [\App\Http\Controllers\Demo\UserJourneyController::class, 'claimed'])->name('claimed');
        Route::get('/already-claimed', [\App\Http\Controllers\Demo\UserJourneyController::class, 'alreadyClaimed'])->name('already.claimed');

        // Demo gift request route - always blocked
        Route::post('/gift-request', [\App\Http\Controllers\Demo\GiftRequestController::class, 'store'])->name('gift-request.store');
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
