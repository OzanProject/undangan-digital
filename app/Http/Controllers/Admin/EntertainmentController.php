<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entertainment;
use App\Models\EventSetting; // Wajib di-import untuk ambil settings
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntertainmentController extends Controller
{
    /**
     * Menampilkan daftar acara hiburan.
     */
    public function index()
    {
        $entertainments = Entertainment::latest()->paginate(10);
        
        // --- LOGIKA FAVICON/LAYOUT START ---
        $settings = EventSetting::first(); // Ambil data settings
        // --- LOGIKA FAVICON/LAYOUT END ---
        
        // Kirim data hiburan DAN settings ke view
        return view('admin.entertainments.index', compact('entertainments', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'type'  => 'required|string|max:50',
            'time'  => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('entertainments', 'public');
        }

        Entertainment::create($data);

        return redirect()->back()->with('success', 'Acara hiburan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $item = Entertainment::findOrFail($id);
        
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}