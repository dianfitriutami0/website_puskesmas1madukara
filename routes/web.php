<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OperatingHourController;
use App\Http\Controllers\Admin\OrganizationStructureController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SambutanController;
use App\Http\Controllers\Admin\ServiceCharterController as AdminServiceCharterController;
use App\Http\Controllers\Admin\ServiceQualityController;
use App\Http\Controllers\Admin\ServiceStandardController as AdminServiceStandardController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\ServiceStandardController;
use Illuminate\Support\Facades\Route;

// ---------- Publik ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Tentang Kami
Route::get('/profil', [PageController::class, 'profile'])->name('profile');
Route::get('/visi-misi', [PageController::class, 'visionMission'])->name('vision-mission');
Route::get('/struktur-organisasi', [PageController::class, 'organizationStructure'])->name('organization-structure');

// Layanan
Route::get('/jenis-layanan', [PageController::class, 'serviceTypes'])->name('service-types.index');
Route::get('/jenis-layanan/{slug}', [PageController::class, 'serviceTypeDetail'])->name('service-types.show');

// Standar Layanan
Route::get('/maklumat-layanan', [PageController::class, 'serviceCharter'])->name('service-charter');
Route::get('/mutu-pelayanan', [PageController::class, 'serviceQuality'])->name('service-quality');
Route::get('/standar-layanan', [ServiceStandardController::class, 'index'])->name('service-standards.index');
Route::get('/standar-layanan/{slug}', [ServiceStandardController::class, 'show'])->name('service-standards.show');

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

    // Standar Layanan
    Route::get('/standar-layanan', [AdminServiceStandardController::class, 'index'])->name('service-standards.index');
    Route::get('/standar-layanan/create', [AdminServiceStandardController::class, 'create'])->name('service-standards.create');
    Route::post('/standar-layanan', [AdminServiceStandardController::class, 'store'])->name('service-standards.store');
    Route::get('/standar-layanan/{serviceStandard}/edit', [AdminServiceStandardController::class, 'edit'])->name('service-standards.edit');
    Route::put('/standar-layanan/{serviceStandard}', [AdminServiceStandardController::class, 'update'])->name('service-standards.update');
    Route::delete('/standar-layanan/{serviceStandard}', [AdminServiceStandardController::class, 'destroy'])->name('service-standards.destroy');
    Route::post('/standar-layanan/{serviceStandard}/toggle-status', [AdminServiceStandardController::class, 'toggleStatus'])->name('service-standards.toggle-status');
    Route::post('/standar-layanan/reorder', [AdminServiceStandardController::class, 'reorder'])->name('service-standards.reorder');

    // Profil
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profiles.update');

    // Struktur Organisasi
    Route::get('/struktur-organisasi', [OrganizationStructureController::class, 'index'])->name('organization-structures.index');
    Route::put('/struktur-organisasi', [OrganizationStructureController::class, 'update'])->name('organization-structures.update');

    // Jenis Layanan
    Route::get('/jenis-layanan', [ServiceTypeController::class, 'index'])->name('service-types.index');
    Route::get('/jenis-layanan/create', [ServiceTypeController::class, 'create'])->name('service-types.create');
    Route::post('/jenis-layanan', [ServiceTypeController::class, 'store'])->name('service-types.store');
    Route::get('/jenis-layanan/{serviceType}/edit', [ServiceTypeController::class, 'edit'])->name('service-types.edit');
    Route::put('/jenis-layanan/{serviceType}', [ServiceTypeController::class, 'update'])->name('service-types.update');
    Route::delete('/jenis-layanan/{serviceType}', [ServiceTypeController::class, 'destroy'])->name('service-types.destroy');
    Route::post('/jenis-layanan/{serviceType}/toggle-status', [ServiceTypeController::class, 'toggleStatus'])->name('service-types.toggle-status');
    Route::post('/jenis-layanan/reorder', [ServiceTypeController::class, 'reorder'])->name('service-types.reorder');

    // Maklumat Layanan
    Route::get('/maklumat-layanan', [ServiceCharterController::class, 'edit'])->name('service-charters.edit');
    Route::put('/maklumat-layanan', [ServiceCharterController::class, 'update'])->name('service-charters.update');

    // Mutu Pelayanan
    Route::get('/mutu-pelayanan', [ServiceQualityController::class, 'edit'])->name('service-qualities.edit');
    Route::put('/mutu-pelayanan', [ServiceQualityController::class, 'update'])->name('service-qualities.update');
});
