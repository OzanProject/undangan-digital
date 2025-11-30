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

        // 1. Dashboard Statistik
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 2. Pengaturan Website
        Route::controller(SettingController::class)->group(function () {
            Route::get('/settings', 'index')->name('settings');
            Route::post('/settings', 'update')->name('settings.update');
        });

        // 3. Manajemen Galeri
        // (Hanya Index, Store, Destroy)
        Route::resource('galleries', GalleryController::class)
            ->except(['show', 'edit', 'update']);

        // 4. Manajemen Hiburan (PERBAIKAN DISINI)
        // Kita gunakan except('show') agar route 'edit' dan 'update' TERBUKA/AKTIF
        Route::resource('entertainments', EntertainmentController::class)
            ->except(['show']);

        // -----------------------------------------------------------
        // 5. MANAJEMEN TAMU (GUESTS)
        // -----------------------------------------------------------
        
        // Export Data (HARUS DIATAS RESOURCE agar tidak tertimpa wildcard {id})
        Route::get('/guests/export/excel', [GuestController::class, 'exportExcel'])->name('guests.excel');
        Route::get('/guests/export/pdf', [GuestController::class, 'exportPdf'])->name('guests.pdf');
        
        // Template Download
        Route::get('/guests/template', [GuestController::class, 'downloadTemplate'])->name('guests.template');

        // Import Action (POST)
        Route::post('/guests/import', [GuestController::class, 'importExcel'])->name('guests.import');
        
        // Link WhatsApp
        Route::get('/guests/{id}/wa', [GuestController::class, 'waLink'])->name('guests.wa');

        // CRUD Standar Tamu
        Route::resource('guests', GuestController::class);

        // -----------------------------------------------------------
        // 6. MANAJEMEN UCAPAN (WISHES)
        // -----------------------------------------------------------

        // Simpan Balasan Admin (Reply) - HARUS DIATAS RESOURCE
        Route::put('/wishes/{id}/reply', [WishController::class, 'reply'])->name('wishes.reply');

        // Resource (Hanya Index dan Hapus)
        Route::resource('wishes', WishController::class)->only(['index', 'destroy']);

        // -----------------------------------------------------------
        // 7. MANAJEMEN USER (ADMIN)
        // -----------------------------------------------------------
        Route::resource('users', UserController::class)
            ->except(['show']);
    });


// ======================================================================
// 🔑 3. AUTHENTICATION
// ======================================================================
require __DIR__ . '/auth.php';