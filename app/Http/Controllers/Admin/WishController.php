<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wish;
use App\Models\EventSetting; // ✅ Wajib di-import untuk ambil settings
use Illuminate\Http\Request;

class WishController extends Controller
{
    /**
     * Menampilkan daftar ucapan
     */
    public function index()
    {
        $wishes = Wish::latest()->paginate(10);
        
        // --- LOGIKA FAVICON/LAYOUT START ---
        $settings = EventSetting::first(); // ✅ Ambil data settings
        // --- LOGIKA FAVICON/LAYOUT END ---

        return view('admin.wishes.index', compact('wishes', 'settings')); // ✅ Kirim $settings
    }

    /**
     * Menghapus ucapan
     */
    public function destroy($id)
    {
        $wish = Wish::findOrFail($id);
        $wish->delete();

        return redirect()->route('admin.wishes.index')->with('success', 'Ucapan berhasil dihapus.');
    }

    /**
     * Simpan Balasan Admin
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:500',
        ]);

        $wish = \App\Models\Wish::findOrFail($id);
        
        $wish->update([
            'reply' => $request->reply
        ]);

        return redirect()->route('admin.wishes.index')->with('success', 'Balasan berhasil dikirim!');
    }
}