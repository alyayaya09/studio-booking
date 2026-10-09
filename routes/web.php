<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PhotographerController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $packages = \App\Models\Package::where('is_active', true)->orderBy('price')->get();

    return view('welcome', compact('packages'));
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/saya', [BookingController::class, 'index'])->name('booking.index');
});

require __DIR__.'/auth.php';

// Area admin: hanya untuk user yang login dan is_admin = true
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('packages', PackageController::class)->except('show');
        Route::resource('photographers', PhotographerController::class)->except('show');
        Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::patch('bookings/{booking}', [AdminBookingController::class, 'update'])->name('bookings.update');
    });