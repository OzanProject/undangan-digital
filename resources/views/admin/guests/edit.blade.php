@extends('layouts.admin')

@section('title', 'Edit Data Tamu')

@section('content')

    {{-- Wrapper --}}
    <div class="max-w-2xl mx-auto">
        
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.guests.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-primary-600 transition-colors font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            
            {{-- Header Card (Nuansa Kuning/Amber untuk Edit) --}}
            <div class="px-8 py-6 border-b border-slate-100 bg-amber-50/50">
                <h3 class="text-lg font-bold text-slate-800">Edit Data Tamu</h3>
                <p class="text-sm text-slate-500">Perbarui informasi tamu undangan.</p>
            </div>

            <form action="{{ route('admin.guests.update', $guest->id) }}" method="POST">
                @csrf
                @method('PUT')
                
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
                            {{-- Logic Error bebas konflik --}}
                            <input type="text" 
                                   name="name" 
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border bg-white text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all 
                                   {{ $errors->has('name') 
                                       ? 'border-red-500 focus:border-red-500 focus:ring-red-200' 
                                       : 'border-slate-300 focus:border-amber-500 focus:ring-amber-200' 
                                   }}" 
                                   value="{{ old('name', $guest->name) }}"
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
                            <input type="number" 
                                   name="phone" 
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border bg-white text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all 
                                   {{ $errors->has('phone') 
                                       ? 'border-red-500 focus:border-red-500 focus:ring-red-200' 
                                       : 'border-slate-300 focus:border-amber-500 focus:ring-amber-200' 
                                   }}" 
                                   value="{{ old('phone', $guest->phone) }}"
                                   required>
                        </div>
                        <small class="text-slate-400 text-xs mt-1 block">
                            Pastikan nomor diawali kode negara (62).
                        </small>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Select Status Kehadiran --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Status Kehadiran
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-check-circle text-slate-400 text-lg"></i>
                            </div>
                            
                            <select name="status" 
                                    class="w-full pl-11 pr-10 py-3 rounded-xl border border-slate-300 bg-white text-slate-700 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 appearance-none cursor-pointer transition-all">
                                <option value="pending" {{ old('status', $guest->status) == 'pending' ? 'selected' : '' }}>
                                    ⏳ Pending (Belum Konfirmasi)
                                </option>
                                <option value="hadir" {{ old('status', $guest->status) == 'hadir' ? 'selected' : '' }}>
                                    ✅ Hadir
                                </option>
                                <option value="tidak_hadir" {{ old('status', $guest->status) == 'tidak_hadir' ? 'selected' : '' }}>
                                    ❌ Tidak Hadir
                                </option>
                            </select>

                            {{-- Panah Dropdown Custom --}}
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500">
                                <i class="bi bi-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Footer Actions --}}
                <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.guests.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                    {{-- Tombol Update warna Amber/Orange --}}
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-amber-500 hover:bg-amber-600 shadow-lg shadow-amber-200 transition-all transform hover:-translate-y-0.5">
                        <i class="bi bi-pencil-square me-1"></i> Perbarui Data
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection