@extends('layouts.admin')

@section('title', 'Detail Tamu')

@section('content')

    {{-- Wrapper --}}
    <div class="max-w-4xl mx-auto">
        
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.guests.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-primary-600 transition-colors font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            
            {{-- Header Card --}}
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Detail Informasi Tamu</h3>
                    <p class="text-sm text-slate-500">Rincian data tamu undangan.</p>
                </div>
                {{-- Tombol Edit (Floating di header) --}}
                <a href="{{ route('admin.guests.edit', $guest->id) }}" class="text-sm font-bold text-amber-500 hover:text-amber-600 flex items-center gap-1">
                    <i class="bi bi-pencil-square"></i> Edit Data
                </a>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    {{-- KOLOM KIRI: DATA DIRI --}}
                    <div class="space-y-6">
                        
                        {{-- Nama --}}
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-1">
                                <i class="bi bi-person-fill"></i> Nama Tamu
                            </label>
                            <div class="text-2xl font-bold text-slate-800">
                                {{ $guest->name }}
                            </div>
                        </div>

                        {{-- No WA --}}
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-1">
                                <i class="bi bi-whatsapp"></i> Nomor WhatsApp
                            </label>
                            <div class="text-lg font-mono font-medium text-slate-700">
                                {{ $guest->phone }}
                            </div>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-2">
                                <i class="bi bi-flag-fill"></i> Status Kehadiran
                            </label>
                            <div>
                                @if($guest->status == 'hadir')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-bold bg-green-100 text-green-700 border border-green-200">
                                        <i class="bi bi-check-circle-fill"></i> Hadir
                                    </span>
                                @elseif($guest->status == 'tidak_hadir')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-bold bg-red-100 text-red-700 border border-red-200">
                                        <i class="bi bi-x-circle-fill"></i> Tidak Hadir
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                        <i class="bi bi-clock-fill"></i> Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-1">
                                <i class="bi bi-calendar3"></i> Terdaftar Pada
                            </label>
                            <div class="text-sm font-medium text-slate-600">
                                {{ $guest->created_at->translatedFormat('d F Y, H:i') }} WIB
                            </div>
                        </div>

                    </div>

                    {{-- KOLOM KANAN: KOTAK LINK & AKSI (Salin Link) --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 flex flex-col justify-between">
                        
                        <div>
                            <h4 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                                <i class="bi bi-link-45deg text-xl text-primary-600"></i> Link Undangan Unik
                            </h4>
                            
                            {{-- INPUT GRUP DENGAN TOMBOL SALIN --}}
                            <div class="flex rounded-xl shadow-sm mb-4 border border-slate-300 overflow-hidden">
                                {{-- Bagian Link (read-only) --}}
                                <input type="text" 
                                    id="invitation-link" 
                                    value="{{ route('invitation', $guest->slug) }}" 
                                    readonly 
                                    class="flex-1 px-4 py-2 bg-white text-primary-600 text-sm font-medium focus:outline-none cursor-text border-0"
                                    onclick="this.select();" 
                                >
                                
                                {{-- Tombol Salin --}}
                                <button type="button" 
                                        onclick="copyToClipboardAdmin('invitation-link')" 
                                        class="px-4 py-2 bg-primary-600 text-white hover:bg-primary-700 transition-colors"
                                        title="Salin ke Clipboard">
                                    <i class="bi bi-clipboard text-lg"></i>
                                </button>
                            </div>
                            
                            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                                Link ini bersifat unik untuk tamu atas nama <b>{{ $guest->name }}</b>.
                            </p>
                        </div>

                        {{-- Tombol Kirim WA --}}
                        <a href="{{ route('admin.guests.wa', $guest->id) }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl shadow-lg shadow-green-200 transition-all transform hover:-translate-y-0.5">
                            <i class="bi bi-whatsapp text-xl"></i>
                            <span>Kirim Undangan via WA</span>
                        </a>

                    </div>

                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                {{-- Tombol Hapus --}}
                <form action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tamu ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold flex items-center gap-1">
                        <i class="bi bi-trash"></i> Hapus Tamu
                    </button>
                </form>

                <a href="{{ route('admin.guests.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-slate-600 hover:bg-slate-700 shadow-lg transition-all">
                    Kembali
                </a>
            </div>

        </div>
    </div>

    {{-- SCRIPT COPY HELPER (Diletakkan di bawah content) --}}
    <script>
        // Fungsi ini harus tersedia di setiap halaman admin yang membutuhkan salin link
        function copyToClipboardAdmin(id) {
            const inputElement = document.getElementById(id);
            
            // Pilih teks di input field
            inputElement.select();
            inputElement.setSelectionRange(0, 99999); 
            
            // Salin teks
            navigator.clipboard.writeText(inputElement.value)
                .then(() => {
                    // Tampilkan notifikasi SweetAlert (Jika tersedia)
                    if(typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Link Disalin!',
                            text: 'Link unik tamu sudah disalin ke clipboard.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        alert("Link berhasil disalin!");
                    }
                })
                .catch(err => {
                    console.error('Gagal menyalin: ', err);
                });
        }
    </script>
@endsection