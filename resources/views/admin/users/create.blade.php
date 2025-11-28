@extends('layouts.admin')

@section('title', 'Tambah User Admin')

@section('content')

    {{-- Wrapper --}}
    <div class="max-w-xl mx-auto">
        
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-primary-600 transition-colors font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar User
            </a>
        </div>

        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            
            {{-- Header Card --}}
            <div class="px-8 py-6 border-b border-slate-100 bg-primary-50">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="bi bi-person-plus-fill text-xl text-primary-600"></i> Tambah Akun Admin
                </h3>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="p-8 space-y-6">
                    
                    {{-- 1. Nama --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-primary-200 focus:border-primary-500' }} transition-all" 
                               placeholder="Contoh: Budi Santoso">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2. Email --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                               class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-primary-200 focus:border-primary-500' }} transition-all" 
                               placeholder="user@admin.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- 3. Password --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                            <input type="password" name="password" required 
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-primary-200 focus:border-primary-500' }} transition-all" 
                                   placeholder="Minimal 8 karakter">
                        </div>

                        {{-- 4. Konfirmasi Password --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required 
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password_confirmation') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-primary-200 focus:border-primary-500' }} transition-all" 
                                   placeholder="Ulangi password">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">Password tidak cocok atau kurang dari 8 karakter.</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-200 transition-all transform hover:-translate-y-0.5">
                        <i class="bi bi-save-fill me-1"></i> Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection