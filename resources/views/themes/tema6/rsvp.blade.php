<div id="rsvp" class="container mx-auto px-4">

    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-violet-700 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Doa & Harapan
        </span>
        {{-- Font Serif Elegan --}}
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
            <div class="bg-white rounded-3xl shadow-xl border border-violet-200 p-6 md:p-8 sticky top-24">
                
                <form id="rsvp-form" method="POST" action="{{ route('wishes.store') }}#rsvp-form">
                    @csrf
                    
                    {{-- Input Nama --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 ps-1">Nama Pengirim</label>
                        <input type="text" 
                                name="sender_name" 
                                value="{{ $guest ? $guest->name : old('sender_name') }}" 
                                {{-- Focus Style Violet --}}
                                class="w-full px-5 py-3 rounded-xl bg-violet-50 border-violet-300 focus:bg-white focus:border-violet-700 focus:ring-2 focus:ring-violet-100 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:font-light"
                                placeholder="Tulis nama Anda disini..." 
                                required>
                    </div>

                    {{-- Input Ucapan --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 ps-1">Ucapan & Doa</label>
                        <textarea name="message" 
                                 rows="4" 
                                 class="w-full px-5 py-3 rounded-xl bg-violet-50 border-violet-300 focus:bg-white focus:border-violet-700 focus:ring-2 focus:ring-violet-100 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:font-light resize-none"
                                 placeholder="Tuliskan doa terbaik untuk ananda..." 
                                 required>{{ old('message') }}</textarea>
                    </div>

                    {{-- Tombol Kirim (Aksen Violet Tua) --}}
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-violet-700 text-white font-bold shadow-xl shadow-violet-300/40 hover:bg-violet-600 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="bi bi-send-fill"></i> Kirim Ucapan
                    </button>

                    {{-- BAGIAN KHUSUS RSVP --}}
                    @if($guest)
                        <div class="mt-8 pt-6 border-t border-dashed border-violet-200">
                            <p class="text-center text-sm font-bold text-slate-700 uppercase tracking-wider mb-4">
                                Konfirmasi Kehadiran
                            </p>
                            <div class="grid grid-cols-2 gap-3">
                                {{-- Tombol HADIR (Aksen Pink Lembut) --}}
                                <button type="submit" 
                                        formaction="{{ route('rsvp', $guest->id) }}#rsvp-form" 
                                        name="status" 
                                        value="hadir" 
                                        class="flex flex-col items-center justify-center py-3 px-2 rounded-xl border border-pink-300 bg-pink-100 text-violet-700 hover:bg-pink-400 hover:text-white hover:border-pink-400 transition-all duration-300 group {{ $guest->status == 'hadir' ? 'bg-pink-400 text-white border-pink-400 shadow-md' : '' }}">
                                    <i class="bi bi-check-circle-fill text-2xl mb-1 group-hover:scale-110 transition-transform"></i>
                                    <span class="text-xs font-bold">Saya Hadir</span>
                                </button>

                                {{-- Tombol TIDAK HADIR (Aksen Merah dipertahankan) --}}
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
            <div class="bg-white rounded-3xl shadow-xl border border-violet-200 h-[600px] flex flex-col relative overflow-hidden">
                
                {{-- Header List (Aksen Violet) --}}
                <div class="p-5 border-b border-violet-200 bg-violet-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-700">Ucapan Terbaru</h3>
                    {{-- Badge Jumlah Pesan (Aksen Violet) --}}
                    <span class="px-3 py-1 rounded-full bg-white border border-violet-300 text-xs font-bold text-violet-700 shadow-sm">
                        {{ count($wishes) }} Pesan
                    </span>
                </div>

                {{-- Scrollable Area --}}
                <div class="flex-1 overflow-y-auto p-5 space-y-6 custom-scrollbar">
                    @forelse($wishes as $wish)
                        @php
                            $initial = strtoupper(substr($wish->sender_name, 0, 1));
                            // Warna Avatar: Violet/Pink/Netral
                            $colors = ['bg-violet-100 text-violet-700', 'bg-pink-100 text-pink-700', 'bg-slate-200 text-slate-700', 'bg-red-100 text-red-700', 'bg-purple-100 text-purple-700'];
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
                                    <div class="bg-pink-50 rounded-2xl rounded-tl-none p-4 border border-pink-200 shadow-sm relative group">
                                        <div class="flex justify-between items-start mb-1">
                                            <h5 class="font-bold text-slate-800 text-sm">{{ $wish->sender_name }}</h5>
                                            <span class="text-[10px] text-slate-500 flex items-center gap-1">
                                                <i class="bi bi-clock"></i> {{ $wish->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-slate-700 text-sm leading-relaxed">
                                            {{ $wish->message }}
                                        </p>
                                    </div>

                                    {{-- Balasan Admin (Aksen Violet) --}}
                                    @if($wish->reply)
                                        <div class="flex gap-3 justify-end animate-fade-in-up" style="animation-delay: 0.1s;">
                                            <div class="bg-violet-100 rounded-2xl rounded-tr-none p-3 border border-violet-200 shadow-sm max-w-[90%] text-right">
                                                <div class="flex justify-end items-center gap-2 mb-1">
                                                    <span class="text-[10px] text-violet-700 font-bold uppercase tracking-wider">
                                                        Tuan Rumah
                                                    </span>
                                                    <i class="bi bi-check-circle-fill text-violet-500 text-xs"></i>
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
                        <div class="h-full flex flex-col items-center justify-center text-violet-600 opacity-60">
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