@extends('layouts.admin')

@section('title', 'Daftar Tamu')

@section('content')

    {{-- 1. HEADER & TOMBOL AKSI --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Data Tamu Undangan</h2>
            <p class="text-sm text-slate-500">Kelola daftar tamu yang akan diundang.</p>
        </div>
        
        {{-- Tombol Aksi (Export, Import, Tambah) --}}
        {{-- FIX: Tambahkan flex-wrap dan w-full untuk stacking responsif --}}
        <div class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto justify-end"> 
            
            {{-- Tombol Export (Dropdown Alpine.js) --}}
            <div x-data="{ open: false }" class="relative w-full sm:w-auto">
                <button @click="open = !open" @click.outside="open = false" class="inline-flex w-full justify-center items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                    <i class="bi bi-download"></i>
                    <span>Export Data</span>
                    <i class="bi bi-chevron-down text-xs"></i>
                </button>
                
                {{-- Dropdown Menu Export --}}
                <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden" style="display: none;">
                    <a href="{{ route('admin.guests.excel') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-green-50 hover:text-green-700 transition-colors border-b border-slate-50">
                        <i class="bi bi-file-earmark-excel-fill text-green-600 text-lg"></i> Download Excel
                    </a>
                    <a href="{{ route('admin.guests.pdf') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                        <i class="bi bi-file-earmark-pdf-fill text-red-600 text-lg"></i> Download PDF
                    </a>
                </div>
            </div>

            {{-- Tombol Import (Modal Trigger) --}}
            <button @click="$dispatch('open-import-modal')" class="inline-flex w-full justify-center sm:w-auto items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-yellow-50 hover:border-yellow-300 transition-all shadow-sm">
                <i class="bi bi-upload"></i> Import Excel
            </button>
            
            {{-- Tombol Tambah --}}
            <a href="{{ route('admin.guests.create') }}" class="inline-flex w-full justify-center sm:w-auto items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 shadow-lg shadow-primary-200 transition-all transform hover:-translate-y-0.5">
                <i class="bi bi-person-plus-fill text-lg"></i> <span>Tambah Baru</span>
            </a>
        </div>
    </div>

    {{-- 2. ALERT SUKSES/ERROR --}}
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 flex items-center justify-between p-4 rounded-xl bg-red-50 border border-red-100 text-red-700">
        <span class="font-medium">{{ session('error') }}</span>
        <button @click="show = false" class="text-red-400 hover:text-red-600"><i class="bi bi-x-lg"></i></button>
    </div>
    @endif

    {{-- 3. TABEL DATA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-bold">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Nama Tamu</th>
                        <th class="px-6 py-4">Kontak (WA)</th>
                        <th class="px-6 py-4 text-center">Status Kehadiran</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @forelse($guests as $key => $guest)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        
                        <td class="px-6 py-4 text-center font-medium text-slate-400">
                            {{ $guests->firstItem() + $key }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 text-base mb-0.5">{{ $guest->name }}</div>
                            <a href="{{ route('invitation', $guest->slug ?? Str::slug($guest->name)) }}" target="_blank" class="text-xs text-primary-500 hover:underline flex items-center gap-1">
                                <i class="bi bi-link-45deg"></i> Lihat Undangan
                            </a>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-whatsapp text-green-500"></i>
                                <span class="font-mono text-slate-700">{{ $guest->phone }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($guest->status == 'hadir')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span> Hadir
                                </span>
                            @elseif($guest->status == 'tidak_hadir')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span> Tidak Hadir
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                
                                {{-- Tombol Kirim WA --}}
                                <a href="{{ route('admin.guests.wa', $guest->id) }}" 
                                   target="_blank"
                                   class="p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 hover:text-green-700 transition-colors border border-green-200" 
                                   title="Kirim Link via WhatsApp">
                                    <i class="bi bi-whatsapp text-lg"></i>
                                </a>

                                {{-- Tombol Detail --}}
                                <a href="{{ route('admin.guests.show', $guest->id) }}" 
                                   class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors border border-blue-200" 
                                   title="Lihat Detail">
                                    <i class="bi bi-eye text-lg"></i>
                                </a> 

                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.guests.edit', $guest->id) }}" 
                                   class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors border border-amber-200" 
                                   title="Edit Data">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <button type="button" 
                                        onclick="confirmDelete('{{ $guest->id }}')"
                                        class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors border border-red-200" 
                                        title="Hapus">
                                    <i class="bi bi-trash text-lg"></i>
                                </button>
                                
                                <form id="delete-form-{{ $guest->id }}" action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="bi bi-people text-5xl mb-3 opacity-50"></i>
                                <p class="text-base font-medium">Belum ada data tamu undangan.</p>
                                <p class="text-sm">Silakan tambahkan tamu baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($guests->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
            {{ $guests->links() }}
        </div>
        @endif

    </div>

    {{-- 4. MODAL IMPORT EXCEL (DIBERI x-data SEBAGAI WRAPPER) --}}
    <div x-data="{ importModalOpen: false }" x-on:open-import-modal.window="importModalOpen = true" x-cloak>
        <div x-show="importModalOpen" x-transition.opacity.duration.300ms class="fixed inset-0 bg-slate-900/75 z-[100] flex items-center justify-center p-4">
            <div @click.outside="importModalOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all overflow-hidden border border-slate-200">
                
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                        <i class="bi bi-file-earmark-spreadsheet-fill text-green-600"></i> Import Data Tamu
                    </h3>
                    <button @click="importModalOpen = false" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
                </div>
                
                <form action="{{ route('admin.guests.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-4">
                        
                        <p class="text-sm text-slate-600">
                            Unduh template, isi datanya, lalu upload file Excel (.xlsx) Anda.
                        </p>
                        
                        {{-- Tombol Download Template --}}
                        <a href="{{ route('admin.guests.template') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 border border-slate-300 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-200 transition-all">
                            <i class="bi bi-file-earmark-arrow-down-fill"></i> Download Template Excel (.xlsx)
                        </a>

                        {{-- Input File --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Pilih File Excel Anda</label>
                            <input type="file" name="file" required class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-xl file:border-0
                                file:text-sm file:font-semibold
                                file:bg-green-50 file:text-green-700
                                hover:file:bg-green-100
                            "/>
                        </div>
                    </div>
                    
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end">
                        <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-green-600 hover:bg-green-700 shadow-lg transition-all">
                            <i class="bi bi-upload"></i> Proses Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SWEETALERT SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true
        });
        Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
    </script>
    @endif
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Data Tamu?', text: "Data yang dihapus tidak dapat dikembalikan!", icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal', customClass: { popup: 'rounded-2xl' }
            }).then((result) => { if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit(); } })
        }
    </script>
@endsection