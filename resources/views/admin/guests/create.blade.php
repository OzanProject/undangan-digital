@extends('layouts.admin')

@section('title', 'Tambah Tamu Baru')

@section('content')

    {{-- Wrapper agar form berada di tengah --}}
    <div class="max-w-2xl mx-auto">
        
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.guests.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-primary-600 transition-colors font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            
            {{-- Header Card --}}
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-bold text-slate-800">Formulir Data Tamu</h3>
                <p class="text-sm text-slate-500">Isi data tamu dengan lengkap dan benar.</p>
            </div>

            <form action="{{ route('admin.guests.store') }}" method="POST">
                @csrf
                
                <div class="p-8 space-y-6">
                    
                    {{-- Input Nama --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Nama Tamu <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-person text-slate-400 text-lg"></i>
                            </div>
                            {{-- PERBAIKAN DI SINI: Menggunakan ternary operator untuk memilih warna border --}}
                            <input type="text" 
                                   name="name" 
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border bg-white text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all 
                                   {{ $errors->has('name') 
                                       ? 'border-red-500 focus:border-red-500 focus:ring-red-200' 
                                       : 'border-slate-300 focus:border-primary-500 focus:ring-primary-200' 
                                   }}" 
                                   placeholder="Masukkan nama lengkap tamu" 
                                   value="{{ old('name') }}"
                                   required>
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Input No WA --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-whatsapp text-slate-400 text-lg"></i>
                            </div>
                            {{-- PERBAIKAN DI SINI: Menggunakan ternary operator untuk memilih warna border --}}
                            <input type="number" 
                                   name="phone" 
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border bg-white text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all 
                                   {{ $errors->has('phone') 
                                       ? 'border-red-500 focus:border-red-500 focus:ring-red-200' 
                                       : 'border-slate-300 focus:border-primary-500 focus:ring-primary-200' 
                                   }}" 
                                   placeholder="Contoh: 628123456789" 
                                   value="{{ old('phone') }}"
                                   required>
                        </div>
                        
                        <div class="flex items-start gap-2 mt-2 text-xs text-slate-500 bg-blue-50 p-2 rounded-lg border border-blue-100">
                            <i class="bi bi-info-circle-fill text-blue-500"></i>
                            <span>Gunakan format internasional tanpa tanda tambah (+). Contoh: <b>62812...</b> (bukan 0812...)</span>
                        </div>

                        @error('phone')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Footer Actions --}}
                <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.guests.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-200 transition-all transform hover:-translate-y-0.5">
                        <i class="bi bi-save2 me-1"></i> Simpan Data
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection