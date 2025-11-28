@extends('layouts.admin')

@section('title', 'Edit User Admin')

@section('content')

    {{-- Wrapper --}}
    <div class="max-w-2xl mx-auto">
        
        {{-- Tombol Kembali --}}
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-primary-600 transition-colors font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar User
            </a>
            
            {{-- Tombol Hapus Cepat --}}
            @if(Auth::id() != $user->id)
                <button type="button" 
                        onclick="confirmDelete('{{ $user->id }}')" 
                        class="text-red-500 hover:text-red-700 text-sm font-bold flex items-center gap-1">
                    <i class="bi bi-trash"></i> Hapus Akun
                </button>
            @endif
        </div>

        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            
            {{-- Header Card --}}
            <div class="px-8 py-6 border-b border-slate-100 bg-amber-50">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="bi bi-pencil-square text-xl text-amber-600"></i> Edit Akun: {{ $user->name }}
                </h3>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-6">
                    
                    {{-- 1. Nama --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-amber-200 focus:border-amber-500' }} transition-all">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- 2. Email --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-amber-200 focus:border-amber-500' }} transition-all">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    
                    {{-- 3. Ganti Password (Opsional) --}}
                    <div class="mt-8 pt-4 border-t border-slate-200">
                        <h4 class="font-bold text-amber-600 mb-4">Ubah Password (Kosongkan jika tidak diubah)</h4>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                                <input type="password" name="password" 
                                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-amber-200 focus:border-amber-500' }} transition-all" 
                                       placeholder="Minimal 8 karakter">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" 
                                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-amber-200 focus:border-amber-500' }} transition-all" 
                                       placeholder="Ulangi password baru">
                            </div>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">Password tidak cocok atau kurang dari 8 karakter.</p>
                        @enderror
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-amber-600 hover:bg-amber-700 shadow-lg shadow-amber-200 transition-all transform hover:-translate-y-0.5">
                        <i class="bi bi-save-fill me-1"></i> Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- DELETE FORM HIDDEN (Untuk tombol Hapus Cepat) --}}
    @if(Auth::id() != $user->id)
        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
            @csrf @method('DELETE')
        </form>
        {{-- Pastikan script SweetAlert sudah ada di index.blade.php / layout --}}
    @endif
@endsection