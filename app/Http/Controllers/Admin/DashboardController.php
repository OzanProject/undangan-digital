<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Wish;
use App\Models\Entertainment; // Wajib di-import
use App\Models\EventSetting;   // Wajib di-import

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Statistik
        $totalGuests = Guest::count();
        $totalWishes = Wish::count();
        $totalEntertainments = Entertainment::count(); // ✅ STATISTIK BARU

        // 2. Ambil Data Pengaturan (Untuk Favicon, Logo Sidebar, dll.)
        $settings = EventSetting::first(); // ✅ DATA LAYOUT

        // 3. Kirim ke View
        return view('admin.dashboard', compact(
            'totalGuests', 
            'totalWishes', 
            'totalEntertainments',
            'settings' // Variabel $settings harus dikirim
        ));
    }
}