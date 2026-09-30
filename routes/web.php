<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Action Submit Form
    Route::post('/carousel', [DashboardController::class, 'storeCarousel'])->name('admin.carousel.store');
    Route::post('/pimpinan', [DashboardController::class, 'updatePimpinan'])->name('admin.pimpinan.update');
    Route::post('/organisasi', [DashboardController::class, 'storeOrganisasi'])->name('admin.organisasi.store');
    Route::post('/standar-pelayanan', [DashboardController::class, 'storeStandarPelayanan'])->name('admin.standar-pelayanan.store');
});