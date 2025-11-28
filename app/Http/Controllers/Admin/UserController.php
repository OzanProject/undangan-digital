<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Models\EventSetting; // ✅ Wajib di-import untuk ambil settings
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Helper untuk mengambil data settings (agar kode lebih rapi)
     */
    private function getSettings()
    {
        return EventSetting::first();
    }

    /**
     * Menampilkan daftar pengguna Admin.
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);
        $settings = $this->getSettings(); // ✅ AMBIL DATA SETTINGS
        
        return view('admin.users.index', compact('users', 'settings'));
    }

    /**
     * Menampilkan form tambah pengguna.
     */
    public function create()
    {
        $settings = $this->getSettings(); // ✅ AMBIL DATA SETTINGS
        return view('admin.users.create', compact('settings'));
    }

    /**
     * Menyimpan pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pengguna.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $settings = $this->getSettings(); // ✅ AMBIL DATA SETTINGS
        return view('admin.users.edit', compact('user', 'settings'));
    }

    /**
     * Memperbarui data pengguna.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

        $data = $request->only('name', 'email');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Akun admin berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Akun admin berhasil dihapus.');
    }
}