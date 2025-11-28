@extends('layouts.admin')

@section('title', 'Buku Tamu & Ucapan')

@section('content')

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Daftar Doa & Ucapan</h2>
            <p class="text-sm text-slate-500">Balas doa dan harapan dari tamu undangan.</p>
        </div>
        <div class="px-4 py-2 bg-emerald-50 border border-emerald-100 rounded-xl text-emerald-700 text-sm font-bold flex items-center gap-2">
            <i class="bi bi-chat-square-heart-fill"></i>
            Total: {{ $wishes->total() }} Pesan
        </div>
    </div>

    {{-- WRAPPER UTAMA DENGAN x-data UNTUK MODAL REPLY --}}
    <div x-data="{ 
            replyModalOpen: false, 
            replyAction: '', 
            replyText: '',
            senderName: '',
            openReplyModal(url, name, currentReply) {
                this.replyAction = url;
                this.senderName = name;
                this.replyText = currentReply; // Isi jika sudah pernah dibalas
                this.replyModalOpen = true;
            }
         }" 
         class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden relative">
        
        {{-- TABEL DATA --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-bold">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4 w-1/4">Pengirim</th>
                        <th class="px-6 py-4 w-1/2">Pesan / Doa</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @forelse($wishes as $key => $wish)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 text-center font-medium text-slate-400 align-top">
                            {{ $wishes->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    {{ substr($wish->sender_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-base">{{ $wish->sender_name }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        {{ $wish->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            {{-- Pesan Tamu --}}
                            <div class="bg-slate-50 p-4 rounded-2xl rounded-tl-none border border-slate-100 relative mb-2">
                                <p class="text-slate-700 italic">"{{ $wish->message }}"</p>
                            </div>

                            {{-- Balasan Admin (Jika Ada) --}}
                            @if($wish->reply)
                                <div class="ml-8 bg-blue-50 p-3 rounded-2xl rounded-tr-none border border-blue-100 relative">
                                    <p class="text-xs text-blue-600 font-bold mb-1 flex items-center gap-1">
                                        <i class="bi bi-reply-fill"></i> Balasan Anda:
                                    </p>
                                    <p class="text-slate-700 text-sm">{{ $wish->reply }}</p>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center align-top">
                            <div class="flex flex-col gap-2 items-center">
                                {{-- Tombol Balas (Trigger Modal) --}}
                                <button @click="openReplyModal('{{ route('admin.wishes.reply', $wish->id) }}', '{{ $wish->sender_name }}', '{{ $wish->reply }}')"
                                        class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-xs font-bold text-white transition-all shadow-sm w-24
                                        {{ $wish->reply ? 'bg-amber-500 hover:bg-amber-600' : 'bg-blue-600 hover:bg-blue-700' }}">
                                    <i class="bi {{ $wish->reply ? 'bi-pencil-square' : 'bi-reply-fill' }}"></i>
                                    {{ $wish->reply ? 'Edit' : 'Balas' }}
                                </button>

                                {{-- Tombol Hapus --}}
                                <button onclick="confirmDelete('{{ $wish->id }}')"
                                        class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-xs font-bold bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 transition-all w-24">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                            
                            <form id="delete-form-{{ $wish->id }}" action="{{ route('admin.wishes.destroy', $wish->id) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-slate-400">Belum ada ucapan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($wishes->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">{{ $wishes->links() }}</div>
        @endif

        {{-- MODAL REPLY (Alpine.js) --}}
        <div x-show="replyModalOpen" 
             style="display: none;"
             class="fixed inset-0 z-[100] overflow-y-auto" 
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            
            {{-- Overlay Gelap --}}
            <div x-show="replyModalOpen" 
                 x-transition.opacity
                 class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity"></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                {{-- Modal Panel --}}
                <div x-show="replyModalOpen" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.outside="replyModalOpen = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
                    
                    <form :action="replyAction" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <i class="bi bi-chat-left-text-fill text-blue-600 text-lg"></i>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg font-semibold leading-6 text-slate-900" id="modal-title">
                                        Balas Ucapan <span x-text="senderName" class="text-blue-600"></span>
                                    </h3>
                                    <div class="mt-4">
                                        <textarea name="reply" rows="4" x-model="replyText"
                                                  class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-3" 
                                                  placeholder="Tulis balasan ucapan di sini... Contoh: Aamiin, terima kasih doanya..."
                                                  required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-100">
                            <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto transition-colors">
                                Kirim Balasan
                            </button>
                            <button type="button" @click="replyModalOpen = false" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- SWEETALERT (Sama seperti sebelumnya) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true
        });
    </script>
    @endif
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Ucapan?', text: "Tidak bisa dikembalikan!", icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal', customClass: { popup: 'rounded-2xl' }
            }).then((result) => { if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit(); } })
        }
    </script>

@endsection