<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RppController;
use App\Http\Controllers\TokenPurchaseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TokenPackageController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Landing Page & Public Legal Compliance Pages (Vije Boutique Resort)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', function () {
    return Inertia::render('Terms');
})->name('terms');
Route::get('/privacy', function () {
    return Inertia::render('Privacy');
})->name('privacy');

// Web Migration & Seeder Script Runner (Public Route for Hosting Deployment)
Route::get('/run-migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);

        // Pure PHP Symlink creation if function is enabled by host
        if (function_exists('symlink')) {
            $target = storage_path('app/public');
            $shortcut = public_path('storage');
            if (!file_exists($shortcut)) {
                @symlink($target, $shortcut);
            }
        }

        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');

        return "<h1>✅ BERHASIL! Database Migration & Storage Link Selesai.</h1><pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre><br><a href='/'>Ke Landing Page Vije Boutique Resort</a> | <a href='/login'>Ke Halaman Login</a>";
    } catch (\Throwable $e) {
        return "<h1>❌ Error: " . htmlspecialchars($e->getMessage()) . "</h1><pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    }
});

// Hostinger Storage Link Fallback
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*')->name('storage.fallback');

// Midtrans Webhook Callback (Public POST route)
Route::post('/api/midtrans/callback', [TokenPurchaseController::class, 'midtransCallback'])->name('midtrans.callback');

// Authenticated User Dashboard Redirect
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasRole('admin') || $user->hasRole('super_admin') || $user->hasRole('reservation_staff') || $user->hasRole('finance')) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

// User Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin CMS & Hotel Management Routes (Admin & Staff Access)
Route::middleware(['auth', 'role:admin|super_admin|reservation_staff|finance'])->prefix('admin')->name('admin.')->group(function () {
    // 1. Dashboard Admin Vije Boutique Resort
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Room & Accommodation Management
    Route::resource('rooms', RoomController::class)->except(['create', 'edit', 'show']);

    // 3. Booking & Reservation Management
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');

    // 4. List User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
});

require __DIR__.'/auth.php';
