@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto')

@section('content')

    <div class="flex flex-col lg:flex-row gap-6 items-start">

        {{-- KOLOM KIRI: FORM UPLOAD (Sticky hanya di Layar Besar) --}}
        {{-- Kita tambahkan lg:sticky lg:top-24 dan hapus sticky/top-24 yang global --}}
        <div class="w-full lg:w-1/3 lg:sticky lg:top-24"> 
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Upload Foto Baru</h3>
                    <p class="text-xs text-slate-500">Format: JPG/PNG, Max: 2MB</p>
                </div>

                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="p-6 space-y-4">
                        
                        {{-- Input File dengan Preview --}}
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                            <input type="file" name="image" id="photo" class="hidden" 
                                    x-ref="photo"
                                    x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => { photoPreview = e.target.result; };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                    "
                                    required />
                            
                            <label for="photo" class="block w-full cursor-pointer group">
                                {{-- State: Belum ada foto --}}
                                <div x-show="!photoPreview" class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center hover:bg-slate-50 hover:border-primary-400 transition-all">
                                    <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                        <i class="bi bi-cloud-arrow-up-fill text-2xl"></i>
                                    </div>
                                    <span class="text-sm font-bold text-slate-600">Klik untuk Pilih Foto</span>
                                    <span class="block text-xs text-slate-400 mt-1">atau drag & drop disini</span>
                                </div>

                                {{-- State: Sudah pilih foto (Preview) --}}
                                <div x-show="photoPreview" style="display: none;" class="relative mt-2">
                                    <span class="block w-full h-48 rounded-xl bg-cover bg-center bg-no-repeat shadow-inner border border-slate-200"
                                            :style="'background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity rounded-xl">
                                        <span class="text-white text-xs font-bold bg-black/50 px-2 py-1 rounded">Ganti Foto</span>
                                    </div>
                                </div>
                            </label>
                        </div>

                        {{-- Input Caption --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Keterangan (Opsional)</label>
                            <input type="text" name="caption" class="w-full px-4 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-all text-sm" placeholder="Contoh: Momen Akad Nikah">
                        </div>

                        {{-- Tombol Upload --}}
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-primary-600 text-white font-bold shadow-lg shadow-primary-200 hover:bg-primary-700 hover:-translate-y-0.5 transition-all">
                            <i class="bi bi-upload me-1"></i> Upload Sekarang
                        </button>

                    </div>
                </form>
            </div>
        </div>

        {{-- KOLOM KANAN: GRID GALERI --}}
        <div class="w-full lg:w-2/3">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Daftar Foto Galeri</h3>
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold">
                        Total: {{ $galleries->total() }}
                    </span>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @forelse($galleries as $img)
                        <div class="group relative rounded-xl overflow-hidden bg-slate-100 shadow-sm border border-slate-200 aspect-square">
                            
                            {{-- Gambar --}}
                            <img src="{{ asset('storage/'.$img->image) }}" 
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                    loading="lazy">

                            {{-- Overlay Gelap (Muncul saat hover) --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                
                                {{-- Caption di overlay --}}
                                @if($img->caption)
                                <p class="text-white text-xs font-medium truncate mb-2">
                                    {{ $img->caption }}
                                </p>
                                @endif

                                {{-- Tombol Hapus --}}
                                <button type="button" 
                                        onclick="confirmDelete('{{ $img->id }}')"
                                        class="w-full py-2 rounded-lg bg-red-500 text-white text-xs font-bold hover:bg-red-600 transition-colors shadow-md flex items-center justify-center gap-1">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>

                            {{-- Form Delete Hidden --}}
                            <form id="delete-form-{{ $img->id }}" action="{{ route('admin.galleries.destroy', $img->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>
                        @empty
                        <div class="col-span-full py-12 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="bi bi-images text-3xl text-slate-300"></i>
                            </div>
                            <p class="text-slate-500 text-sm font-medium">Belum ada foto di galeri.</p>
                            <p class="text-xs text-slate-400">Upload foto pertama Anda sekarang.</p>
                        </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($galleries->hasPages())
                    <div class="mt-6 pt-4 border-t border-slate-100 bg-slate-50">
                        {{ $galleries->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
    
@endsection