<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\GuestsExport;
use App\Imports\GuestsImport;

// Library Export & Layout
use App\Models\EventSetting; // Diperlukan untuk Favicon
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuestsTemplateExport;

class GuestController extends Controller
{
    /**
     * Helper untuk mengambil data settings (agar kode lebih rapi)
     */
    private function getSettings()
    {
        return EventSetting::first();
    }

    /**
     * Menampilkan daftar tamu
     */
    public function index()
    {
        $guests = Guest::latest()->paginate(10);
        $settings = $this->getSettings(); // ✅ AMBIL DATA SETTINGS
        
        return view('admin.guests.index', compact('guests', 'settings'));
    }

    /**
     * Menampilkan form tambah tamu
     */
    public function create()
    {
        $settings = $this->getSettings(); // ✅ AMBIL DATA SETTINGS
        return view('admin.guests.create', compact('settings'));
    }

    /**
     * Menyimpan data tamu baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
        ]);

        $slug = Str::slug($request->name) . '-' . Str::lower(Str::random(5));

        Guest::create([
            'name' => $request->name,
            'slug' => $slug,
            'phone' => $request->phone,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.guests.index')->with('success', 'Tamu berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail tamu
     */
    public function show($id)
    {
        $guest = Guest::findOrFail($id);
        $settings = $this->getSettings(); // ✅ AMBIL DATA SETTINGS
        return view('admin.guests.show', compact('guest', 'settings'));
    }

    /**
     * Menampilkan form edit tamu
     */
    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        $settings = $this->getSettings(); // ✅ AMBIL DATA SETTINGS
        return view('admin.guests.edit', compact('guest', 'settings'));
    }

    /**
     * Update data tamu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'status' => 'required|in:pending,hadir,tidak_hadir',
        ]);

        $guest = Guest::findOrFail($id);
        
        $guest->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.guests.index')->with('success', 'Data tamu berhasil diperbarui!');
    }

    /**
     * Hapus data tamu
     */
    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->route('admin.guests.index')->with('success', 'Tamu berhasil dihapus.');
    }

    /**
     * Generate Link WhatsApp Otomatis
     */
    public function waLink($id)
    {
        $guest = Guest::findOrFail($id);
        $linkUndangan = route('invitation', $guest->slug);

        $message = "Assalamu'alaikum Wr. Wb.\n\n";
        $message .= "Kepada Yth. Bapak/Ibu/Saudara/i *$guest->name*,\n\n";
        $message .= "Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara tasyakur khitan putra kami.\n\n";
        $message .= "Info lengkap acara & lokasi bisa dilihat di link berikut:\n";
        $message .= "$linkUndangan \n\n";
        $message .= "Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.\n\n";
        $message .= "Wassalamu'alaikum Wr. Wb.";

        $encodedMessage = urlencode($message);

        return redirect()->away("https://wa.me/{$guest->phone}?text={$encodedMessage}");
    }

    /**
     * EXPORT KE EXCEL
     */
    public function exportExcel()
    {
        return Excel::download(new GuestsExport, 'daftar-tamu-'.date('Y-m-d').'.xlsx');
    }

    /**
     * EXPORT KE PDF
     */
    public function exportPdf()
    {
        $guests = Guest::all();
        $event  = EventSetting::first(); 

        $pdf = Pdf::loadView('admin.guests.pdf', compact('guests', 'event'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('laporan-tamu-'.date('Y-m-d').'.pdf');
    }

    /**
     * Download template Excel untuk Import
     */
    public function downloadTemplate()
    {
        return Excel::download(new GuestsTemplateExport, 'template-tamu.xlsx');
    }

    /**
     * Proses Import file Excel dari Admin
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx|max:5000',
        ]);

        try {
            Excel::import(new GuestsImport, $request->file('file'));
            
            return redirect()->back()->with('success', 'Data tamu berhasil diimport!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('error', 'Gagal mengimport data. Cek format file Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimport file.');
        }
    }
}