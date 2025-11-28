<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\EventSetting; // Wajib di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Menampilkan halaman galeri (Index).
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(8);
        
        // --- LOGIKA FAVICON/LAYOUT START ---
        $settings = EventSetting::first(); // ✅ Data settings diambil
        // --- LOGIKA FAVICON/LAYOUT END ---

        // PERBAIKAN: Variabel $settings harus ditambahkan ke compact()
        return view('admin.galleries.index', compact('galleries', 'settings')); // ✅ Diperbaiki
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        Gallery::create([
            'caption' => $request->caption,
            'image' => $request->file('image')->store('galleries', 'public'),
        ]);

        return back()->with('success', 'Foto berhasil diupload!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Foto dihapus!');
    }
}