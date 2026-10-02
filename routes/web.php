<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OperatingHourController;
use App\Http\Controllers\Admin\SambutanController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// ---------- Publik ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// ---------- Auth ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// ---------- Dashboard Admin ----------
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Slider (4 slot)
    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::post('/sliders/{position}', [SliderController::class, 'upsert'])
        ->whereIn('position', [1, 2, 3, 4])->name('sliders.upsert');
    Route::delete('/sliders/{position}', [SliderController::class, 'destroy'])
        ->whereIn('position', [1, 2, 3, 4])->name('sliders.destroy');

    // Sambutan Kepala Puskesmas (single record)
    Route::get('/sambutan', [SambutanController::class, 'edit'])->name('sambutan.edit');
    Route::put('/sambutan', [SambutanController::class, 'update'])->name('sambutan.update');

    // Jam pelayanan (JSON file, tanpa database)
    Route::get('/jam-pelayanan', [OperatingHourController::class, 'edit'])->name('hours.edit');
    Route::put('/jam-pelayanan', [OperatingHourController::class, 'update'])->name('hours.update');

    // Berita & Galeri
    Route::resource('news', AdminNewsController::class)->except('show');
    Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/galeri', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/galeri/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
});