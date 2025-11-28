<?php

namespace App\Http\Controllers;

use App\Models\EventSetting;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Menampilkan halaman undangan.
     * Asumsi: hanya ada satu record EventSetting (konfigurasi global).
     */
    public function index(Request $request)
    {
        // Ambil satu event setting saja, misalnya yang pertama
        $event = EventSetting::firstOrFail();

        // Tema diambil dari kolom 'theme', default 'tema1'
        $theme = $event->theme ?? 'tema1';

        // Opsional: nama tamu dari query string ?to=Nama
        $guestName = $request->query('to', 'Tamu Undangan');

        return view('landing', compact('event', 'theme', 'guestName'));
    }
}
