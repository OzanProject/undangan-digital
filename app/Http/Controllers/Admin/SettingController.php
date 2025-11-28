<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventSetting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     */
    public function index()
    {
        // Ambil satu-satunya record event setting
        $settings = EventSetting::first();

        // Kirim daftar tema dari konstanta model
        $themes = EventSetting::THEMES;

        return view('admin.settings.index', compact('settings', 'themes'));
    }

    /**
     * Memperbarui data pengaturan.
     */
    public function update(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            // Data teks
            'child_name'            => 'nullable|string|max:255',
            'parent_names'          => 'nullable|string|max:255',
            'turut_mengundang_ayah' => 'nullable|string',
            'turut_mengundang_ibu'  => 'nullable|string',
            'event_date'            => 'nullable|date',
            'location_name'         => 'nullable|string|max:255',
            'location_address'      => 'nullable|string',
            'maps_iframe'           => 'nullable|string',

            // Data Bank
            'bank_name_1'           => 'nullable|string|max:100',
            'bank_acc_1'            => 'nullable|string|max:50',
            'bank_holder_1'         => 'nullable|string|max:100',
            'bank_name_2'           => 'nullable|string|max:100',
            'bank_acc_2'            => 'nullable|string|max:50',
            'bank_holder_2'         => 'nullable|string|max:100',

            // File Uploads
            'hero_image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'child_photo'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'logo_path'             => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'audio_path'            => 'nullable|file|mimes:mp3,wav|max:5120',

            // PILIHAN TEMA (sangat penting)
            'theme' => 'required|string|in:' . implode(',', array_keys(EventSetting::THEMES)),
        ]);

        // 2. Ambil data setting yang ada atau buat baru
        $settings = EventSetting::first() ?? new EventSetting();

        // 3. Ambil semua input kecuali file upload
        $data = $request->except([
            'hero_image',
            'child_photo',
            'logo_path',
            'audio_path',
            '_token',
            '_method'
        ]);

        // ================================
        // 4. PROSES FILE UPLOAD
        // ================================

        // A. Hero Image
        if ($request->hasFile('hero_image')) {
            if ($settings->hero_image) {
                Storage::disk('public')->delete($settings->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('settings', 'public');
        }

        // B. Child Photo
        if ($request->hasFile('child_photo')) {
            if ($settings->child_photo) {
                Storage::disk('public')->delete($settings->child_photo);
            }
            $data['child_photo'] = $request->file('child_photo')->store('settings', 'public');
        }

        // C. Logo
        if ($request->hasFile('logo_path')) {
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $data['logo_path'] = $request->file('logo_path')->store('settings', 'public');
        }

        // D. Audio
        if ($request->hasFile('audio_path')) {
            if ($settings->audio_path) {
                Storage::disk('public')->delete($settings->audio_path);
            }
            $data['audio_path'] = $request->file('audio_path')->store('settings', 'public');
        }

        // ================================
        // 5. SIMPAN SEMUA DATA
        // ================================
        $settings->fill($data);
        $settings->save();

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}
