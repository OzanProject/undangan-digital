<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// Import semua Model yang dibutuhkan
use App\Models\EventSetting;
use App\Models\Guest;
use App\Models\Wish;
use App\Models\Entertainment;

class HomeController extends Controller
{
    /**
     * Menampilkan Halaman Landing Page (Frontend)
     * Dipanggil oleh:
     *  - GET /          (route name: home)
     *  - GET /u/{slug}  (route name: invitation)
     */
    public function index($slug = null)
    {
        // 1. Ambil data pengaturan acara
        $event = EventSetting::first();

        // ---------------------------------------------------------
        // SAFETY NET: JIKA DATABASE KOSONG (Admin belum isi data)
        // ---------------------------------------------------------
        if (!$event) {
            $event = new EventSetting();
            $event->child_name     = "Nama Anak (Belum Diisi)";
            $event->parent_names   = "Orang Tua (Belum Diisi)";
            
            // Set default tanggal hari ini
            $event->event_date     = Carbon::now(); 
            
            $event->location_name  = "Lokasi Belum Diatur";
            $event->location_address = "Alamat belum diisi di Admin Panel";
            $event->maps_iframe    = null;
            $event->hero_image     = null;
            $event->child_photo    = null;
            $event->audio_path     = null;

            // Tema default jika belum ada data
            $event->theme          = 'tema1';
            
            // Bank null
            $event->bank_name_1    = null;
            $event->bank_acc_1     = null;
            $event->bank_holder_1  = null;
            $event->bank_name_2    = null;
            $event->bank_acc_2     = null;
            $event->bank_holder_2  = null;
        }

        // 2. Tentukan tema yang dipakai (fallback ke 'tema1')
        $theme = $event->theme ?? 'tema1';

        // 3. Ambil Data Pendukung
        $wishes         = Wish::latest()->get();        // Daftar Ucapan
        $entertainments = Entertainment::all();         // Daftar Hiburan
        
        // 4. Logika Tamu Spesial (via Link /u/slug)
        $guestName = "Tamu Kehormatan"; 
        $guest     = null;

        if ($slug) {
            $guest = Guest::where('slug', $slug)->first();
            if ($guest) {
                $guestName = $guest->name;
            }
        }

        // 5. Kirim semua data ke View 'landing'
        return view('landing', compact(
            'event', 
            'wishes', 
            'guestName', 
            'guest', 
            'entertainments',
            'theme'          // <- PENTING: dikirim ke view agar @include("themes.$theme.*") bekerja
        ));
    }

    /**
     * Menyimpan Ucapan / Doa
     */
    public function storeWish(Request $request)
    {
        $request->validate([
            'sender_name' => 'required|string|max:50',
            'message'     => 'required|string|max:500',
        ]);

        Wish::create([
            'sender_name' => $request->sender_name,
            'message'     => $request->message,
        ]);

        // Redirect kembali ke bagian #rsvp
        return redirect()->to(url()->previous() . '#rsvp')
                         ->with('success', 'Terima kasih, doa Anda telah terkirim!');
    }

    /**
     * Menyimpan Konfirmasi Kehadiran (RSVP)
     */
    public function rsvp($id, Request $request)
    {
        $guest = Guest::findOrFail($id);
        
        $guest->update([
            'status' => $request->status 
        ]);

        // Redirect kembali ke bagian #rsvp
        return redirect()->to(url()->previous() . '#rsvp')
                         ->with('success', 'Konfirmasi kehadiran berhasil disimpan!');
    }
}
