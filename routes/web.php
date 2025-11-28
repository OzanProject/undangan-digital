<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WishController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EntertainmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======================================================================
// 🌐 1. FRONTEND (Public Landing Page)
// ======================================================================
Route::controller(HomeController::class)->group(function () {
    // Halaman Utama
    Route::get('/', 'index')->name('home');
    
    // Halaman Undangan Personal
    Route::get('/u/{slug}', 'index')->name('invitation');
    
    // Kirim Ucapan & RSVP
    Route::post('/wishes', 'storeWish')->name('wishes.store');
    Route::post('/rsvp/{id}', 'rsvp')->name('rsvp');
});


// ======================================================================
// 🔐 2. BACKEND / ADMIN
// ======================================================================
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.') // Prefix nama route: admin.dashboard, admin.guests.index, dll
    ->group(function () {

        // Dashboard Statistik
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Pengaturan Website
        Route::controller(SettingController::class)->group(function () {
            Route::get('/settings', 'index')->name('settings');
            Route::post('/settings', 'update')->name('settings.update');
        });

        // Manajemen Galeri
        Route::resource('galleries', GalleryController::class)
            ->except(['show', 'edit', 'update']);

        // Manajemen Hiburan
        Route::resource('entertainments', EntertainmentController::class)
            ->only(['index', 'store', 'destroy']);
        // -----------------------------------------------------------
        // MANAJEMEN TAMU (GUESTS)
        // -----------------------------------------------------------
        
        // 1. Export Data (HARUS DIATAS RESOURCE)
        Route::get('/guests/export/excel', [GuestController::class, 'exportExcel'])->name('guests.excel');
        Route::get('/guests/export/pdf', [GuestController::class, 'exportPdf'])->name('guests.pdf');
        
        // Template Download
        Route::get('/guests/template', [GuestController::class, 'downloadTemplate'])->name('guests.template');

        // Import Action (POST)
        Route::post('/guests/import', [GuestController::class, 'importExcel'])->name('guests.import');
        
        // 2. Link WhatsApp
        Route::get('/guests/{id}/wa', [GuestController::class, 'waLink'])->name('guests.wa');

        // 3. CRUD Standar
        Route::resource('guests', GuestController::class);

        // -----------------------------------------------------------
        // MANAJEMEN UCAPAN (WISHES)
        // -----------------------------------------------------------

        // 1. Simpan Balasan Admin (Reply) - HARUS DIATAS RESOURCE
        Route::put('/wishes/{id}/reply', [WishController::class, 'reply'])->name('wishes.reply');

        // 2. Resource (Hanya Index dan Hapus)
        Route::resource('wishes', WishController::class)->only(['index', 'destroy']);

        Route::resource('users', UserController::class)
        ->except(['show']);
    });


// ======================================================================
// 🔑 3. AUTHENTICATION
// ======================================================================
require __DIR__ . '/auth.php';