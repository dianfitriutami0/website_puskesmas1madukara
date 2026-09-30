<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\CarouselBanner;
use App\Models\ProfilPimpinan;

// Route untuk Halaman Depan (User)
Route::get('/', function () {
    $carousels = CarouselBanner::all();
    $pimpinan = ProfilPimpinan::first();
    return view('welcome', compact('carousels', 'pimpinan'));
});

// Route untuk Dashboard Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/carousel/store', [DashboardController::class, 'storeCarousel'])->name('admin.carousel.store');
    Route::post('/pimpinan/store', [DashboardController::class, 'updatePimpinan'])->name('admin.pimpinan.store');
});