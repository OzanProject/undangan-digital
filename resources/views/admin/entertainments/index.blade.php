@extends('layouts.admin')

@section('title', 'Kelola Acara Hiburan')

@section('content')

    <div class="flex flex-col lg:flex-row gap-6 items-start">

        {{-- KOLOM KIRI: FORM TAMBAH (Sticky hanya di Layar Besar) --}}
        <div class="w-full lg:w-1/3 lg:sticky lg:top-24">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Tambah Hiburan</h3>
                </div>
                <form action="{{ route('admin.entertainments.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    
                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Pengisi Acara</label>
                        <input type="text" name="name" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500" placeholder="Contoh: Gambus El-Corona" required>
                    </div>

                    {{-- Jenis --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Jenis Hiburan</label>
                        <input type="text" name="type" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500" placeholder="Contoh: Musik Religi / Tausiyah" required>
                    </div>

                    {{-- Jam --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Waktu Tampil</label>
                        <input type="text" name="time" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500" placeholder="Contoh: 09:00 - 12:00 WIB" required>
                    </div>

                    {{-- Foto --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Foto / Poster (Opsional)</label>
                        <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100"/>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 transition-all">
                        <i class="bi bi-plus-circle me-1"></i> Tambahkan
                    </button>
                </form>
            </div>
        </div>

        {{-- KOLOM KANAN: DAFTAR HIBURAN --}}
        <div class="w-full lg:w-2/3">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Daftar Acara</h3>
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold">
                        Total: {{ $entertainments->total() }}
                    </span>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($entertainments as $item)
                    <div class="group relative bg-white rounded-xl overflow-hidden shadow-sm border border-slate-100 hover:border-primary-200 hover:shadow-md transition-all flex items-start p-3">
                        
                        {{-- Image --}}
                        <div class="w-16 h-16 rounded-lg bg-slate-100 shrink-0 overflow-hidden mr-3">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <i class="bi bi-music-note-beamed text-2xl"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary-600 bg-primary-50 px-2 py-0.5 rounded-full">
                                    {{ $item->type }}
                                </span>
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.entertainments.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="shrink-0 ml-2">
                                    @csrf @method('DELETE')
                                    <button class="text-slate-300 hover:text-red-500 transition-colors"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </div>
                            
                            <h4 class="font-bold text-slate-800 mt-1.5 truncate">{{ $item->name }}</h4>
                            <p class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                                <i class="bi bi-clock"></i> {{ $item->time }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-10 text-center text-slate-400">
                        <i class="bi bi-emoji-frown text-4xl mb-2"></i>
                        <p>Belum ada acara hiburan.</p>
                    </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                @if($entertainments->hasPages())
                    <div class="p-6 border-t border-slate-100 bg-slate-50">
                        {{ $entertainments->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection