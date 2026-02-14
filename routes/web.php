<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Middleware\RedirectIfAdminAuthenticated;

// Public routes with admin redirect protection
Route::middleware([RedirectIfAdminAuthenticated::class])->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/check-booking', function() {
        return view('booking.check');
    })->name('booking.check.form');
    Route::get('/slots', [BookingController::class, 'slots']);
    Route::post('/book', [BookingController::class, 'store']);
    Route::get('/booking/success/{booking}', [BookingController::class, 'success'])->name('booking.success');
    
    // Check booking routes
    Route::post('/check-booking', [BookingController::class, 'check'])->name('booking.check');
    Route::get('/booking/result/{booking}', [BookingController::class, 'result'])->name('booking.result');
});

// Admin routes
Route::get('/admin', function() {
    if (Auth::guard('admin')->check()) {
        return redirect('/admin/dashboard');
    }
    return view('admin.login-link');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminBookingController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/bookings/{id}', [AdminBookingController::class, 'cancel'])->name('admin.booking.cancel');
    Route::get('/bookings/create', [AdminBookingController::class, 'create'])->name('admin.booking.create');
    Route::post('/bookings', [AdminBookingController::class, 'store'])->name('admin.booking.store');
    Route::get('/bookings/{id}/edit', [AdminBookingController::class, 'edit'])->name('admin.booking.edit');
    Route::put('/bookings/{id}', [AdminBookingController::class, 'update'])->name('admin.booking.update');
    
    // Settings routes
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');
    Route::put('/settings', [AdminSettingsController::class, 'update'])->name('admin.settings.update');
});