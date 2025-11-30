<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Entertainment;
use App\Models\EventSetting; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EntertainmentController extends Controller
{
    public function index()
    {
        $entertainments = Entertainment::latest()->paginate(10);
        $settings = EventSetting::first();
        
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

    /**
     * Menampilkan Form Edit
     */
    public function edit($id)
    {
        $entertainment = Entertainment::findOrFail($id);
        return view('admin.entertainments.edit', compact('entertainment'));
    }

    /**
     * Proses Update Data
     */
    public function update(Request $request, $id)
    {
        $item = Entertainment::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:100',
            'type'  => 'required|string|max:50',
            'time'  => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Image jadi nullable (tidak wajib)
        ]);

        $data = $request->all();

        // Logika Ganti Gambar
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama jika ada
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            // 2. Upload gambar baru
            $data['image'] = $request->file('image')->store('entertainments', 'public');
        } else {
            // Jika user tidak upload gambar baru, hapus key 'image' agar data lama tidak tertimpa null
            unset($data['image']);
        }

        $item->update($data);

        return redirect()->route('admin.entertainments.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Entertainment::findOrFail($id);
        
        // Tidak perlu tulis Storage::delete disini lagi.
        // Model sudah menanganinya secara otomatis di method booted().
        
        $item->delete(); 

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}