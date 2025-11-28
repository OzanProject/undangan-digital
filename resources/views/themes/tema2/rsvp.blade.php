<div id="rsvp" class="container mx-auto px-4">

    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        {{-- Aksen Hijau Tua --}}
        <span class="text-green-700 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Doa & Harapan
        </span>
        {{-- Font Elegan --}}
        <h2 class="font-serif-elegan text-4xl md:text-5xl text-slate-800 mt-2">
            Kirimkan Ucapan
        </h2>
        <p class="text-slate-600 mt-3 max-w-lg mx-auto font-light">
            Doa restu Anda merupakan kado terindah bagi kami.
        </p>
    </div>

    <div class="grid md:grid-cols-12 gap-8 lg:gap-12 items-start">
        
        {{-- KOLOM 1: FORM INPUT & RSVP --}}
        <div class="md:col-span-5 lg:col-span-5" data-aos="fade-right">
            {{-- Card Form: Shadow Lebih Dalam & Border Hijau --}}
            <div class="bg-white rounded-3xl shadow-2xl border border-green-50 p-6 md:p-8 sticky top-24">
                
                <form id="rsvp-form" method="POST" action="{{ route('wishes.store') }}#rsvp-form">
                    @csrf
                    
                    {{-- Input Nama (Gaya Elegan) --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 ps-1">Nama Pengirim</label>
                        <input type="text" 
                                name="sender_name" 
                                value="{{ $guest ? $guest->name : old('sender_name') }}" 
                                {{-- Focus Style Hijau --}}
                                class="w-full px-5 py-3 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:font-light"
                                placeholder="Tulis nama Anda disini..." 
                                required>
                    </div>

                    {{-- Input Ucapan (Gaya Elegan) --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 ps-1">Ucapan & Doa</label>
                        <textarea name="message" 
                                 rows="4" 
                                 {{-- Focus Style Hijau --}}
                                 class="w-full px-5 py-3 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-green-500 focus:ring-2 focus:ring-green-100 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:font-light resize-none"
                                 placeholder="Tuliskan doa terbaik untuk ananda..." 
                                 required>{{ old('message') }}</textarea>
                    </div>

                    {{-- Tombol Kirim (Aksen Hijau Tua) --}}
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-green-800 text-white font-bold shadow-xl shadow-green-900/40 hover:bg-green-700 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="bi bi-send-fill"></i> Kirim Ucapan
                    </button>

                    {{-- BAGIAN KHUSUS RSVP --}}
                    @if($guest)
                        <div class="mt-8 pt-6 border-t border-dashed border-green-200">
                            <p class="text-center text-sm font-bold text-slate-700 uppercase tracking-wider mb-4">
                                Konfirmasi Kehadiran
                            </p>
                            <div class="grid grid-cols-2 gap-3">
                                {{-- Tombol HADIR (Aksen Hijau) --}}
                                <button type="submit" 
                                        formaction="{{ route('rsvp', $guest->id) }}#rsvp-form" 
                                        name="status" 
                                        value="hadir" 
                                        class="flex flex-col items-center justify-center py-3 px-2 rounded-xl border border-green-300 bg-green-100 text-green-700 hover:bg-green-700 hover:text-white hover:border-green-700 transition-all duration-300 group {{ $guest->status == 'hadir' ? 'bg-green-700 text-white border-green-700 shadow-md' : '' }}">
                                    <i class="bi bi-check-circle-fill text-2xl mb-1 group-hover:scale-110 transition-transform"></i>
                                    <span class="text-xs font-bold">Saya Hadir</span>
                                </button>

                                {{-- Tombol TIDAK HADIR (Aksen Merah) --}}
                                {{-- Aksen merah dipertahankan karena menandakan status negatif --}}
                                <button type="submit" 
                                        formaction="{{ route('rsvp', $guest->id) }}#rsvp-form" 
                                        name="status" 
                                        value="tidak_hadir" 
                                        class="flex flex-col items-center justify-center py-3 px-2 rounded-xl border border-red-300 bg-red-100 text-red-700 hover:bg-red-700 hover:text-white hover:border-red-700 transition-all duration-300 group {{ $guest->status == 'tidak_hadir' ? 'bg-red-700 text-white border-red-700 shadow-md' : '' }}">
                                    <i class="bi bi-x-circle-fill text-2xl mb-1 group-hover:scale-110 transition-transform"></i>
                                    <span class="text-xs font-bold">Maaf Berhalangan</span>
                                </button>
                            </div>
                        </div>
                    @endif

                </form>
            </div>
        </div>

        {{-- KOLOM 2: LIST UCAPAN (TIMELINE STYLE) --}}
        <div class="md:col-span-7 lg:col-span-7" data-aos="fade-left">
            {{-- Card List: Shadow Lebih Dalam & Border Hijau --}}
            <div class="bg-white rounded-3xl shadow-2xl border border-green-50 h-[600px] flex flex-col relative overflow-hidden">
                
                {{-- Header List (Aksen Hijau) --}}
                <div class="p-5 border-b border-green-100 bg-green-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-700">Ucapan Terbaru</h3>
                    {{-- Badge Jumlah Pesan (Aksen Hijau) --}}
                    <span class="px-3 py-1 rounded-full bg-white border border-green-200 text-xs font-bold text-green-700 shadow-sm">
                        {{ count($wishes) }} Pesan
                    </span>
                </div>

                {{-- Scrollable Area --}}
                <div class="flex-1 overflow-y-auto p-5 space-y-6 custom-scrollbar">
                    @forelse($wishes as $wish)
                        @php
                            $initial = strtoupper(substr($wish->sender_name, 0, 1));
                            // Mengganti warna Avatar agar tetap elegan dan menyatu dengan tema (gunakan shade Hijau, Emas/Kuning, dan netral)
                            $colors = ['bg-green-100 text-green-700', 'bg-amber-100 text-amber-700', 'bg-slate-200 text-slate-700', 'bg-teal-100 text-teal-700', 'bg-lime-100 text-lime-700'];
                            $colorClass = $colors[$loop->index % count($colors)];
                        @endphp

                        <div class="animate-fade-in-up">
                            <div class="flex gap-4">
                                {{-- Avatar --}}
                                <div class="flex-shrink-0 w-10 h-10 rounded-full {{ $colorClass }} flex items-center justify-center font-bold shadow-sm">
                                    {{ $initial }}
                                </div>
                                
                                {{-- Bubble Chat --}}
                                <div class="flex-1 space-y-2">
                                    {{-- Pesan Tamu (Netral) --}}
                                    <div class="bg-slate-50 rounded-2xl rounded-tl-none p-4 border border-slate-100 shadow-sm relative group">
                                        <div class="flex justify-between items-start mb-1">
                                            <h5 class="font-bold text-slate-800 text-sm">{{ $wish->sender_name }}</h5>
                                            <span class="text-[10px] text-slate-400 flex items-center gap-1">
                                                <i class="bi bi-clock"></i> {{ $wish->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-slate-600 text-sm leading-relaxed">
                                            {{ $wish->message }}
                                        </p>
                                    </div>

                                    {{-- Balasan Admin (Aksen Hijau) --}}
                                    @if($wish->reply)
                                        <div class="flex gap-3 justify-end animate-fade-in-up" style="animation-delay: 0.1s;">
                                            {{-- Bubble Balasan --}}
                                            <div class="bg-green-50 rounded-2xl rounded-tr-none p-3 border border-green-100 shadow-sm max-w-[90%] text-right">
                                                <div class="flex justify-end items-center gap-2 mb-1">
                                                    <span class="text-[10px] text-green-700 font-bold uppercase tracking-wider">
                                                        Tuan Rumah
                                                    </span>
                                                    <i class="bi bi-check-circle-fill text-green-500 text-xs"></i>
                                                </div>
                                                <p class="text-slate-700 text-sm leading-relaxed">
                                                    {{ $wish->reply }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-green-400 opacity-60">
                            <i class="bi bi-chat-heart text-5xl mb-3"></i>
                            <p class="text-sm">Belum ada ucapan. Jadilah yang pertama!</p>
                        </div>
                    @endforelse
                </div>
                
                {{-- Fade Out di Bawah List --}}
                <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
            </div>
        </div>

    </div>
</div>

{{-- CSS Scrollbar (Ganti warna thumb scrollbar ke netral gelap) --}}
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #9ca3af; /* slate-400 */ border-radius: 20px; }
</style>

{{-- SWEETALERT 2 (Notifikasi Sukses) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    // Cek session flash 'success' dari controller
    Swal.fire({
        title: 'Terima Kasih!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#10B981', // Emerald Green (Aksen Hijau Tema 2)
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'rounded-3xl', // Gaya modern rounded
            confirmButton: 'px-6 py-2 rounded-xl font-bold'
        }
    });
</script>
@endif