<div id="entertainment" class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        {{-- Aksen Emas Tua --}}
        <span class="text-amber-700 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Rundown & Hiburan
        </span>
        {{-- Font Classic --}}
        <h2 class="font-serif-classic text-4xl md:text-5xl text-slate-800 mt-2">
            Turut Dimeriahkan Oleh
        </h2>
    </div>

    {{-- Grid Content --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
        
        {{-- Looping Data --}}
        @forelse($entertainments as $item)
            {{-- Card: Border, Shadow, dan Hover yang lebih Premium --}}
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-xl border border-amber-50 hover:shadow-2xl hover:border-amber-100 hover:-translate-y-2 transition-all duration-300" 
                 data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                
                {{-- Image Header --}}
                <div class="h-48 bg-slate-200 relative overflow-hidden">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        {{-- Placeholder: Aksen Gradient Emas --}}
                        <div class="w-full h-full bg-gradient-to-br from-amber-600 to-amber-800 flex items-center justify-center text-white">
                            <i class="bi bi-music-note-beamed text-5xl opacity-70"></i>
                        </div>
                    @endif
                    
                    {{-- Badge Type (Aksen Emas) --}}
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-amber-700 shadow-md">
                        {{ $item->type }}
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6 text-center">
                    {{-- Nama: Aksen Hover Emas --}}
                    <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-amber-800 transition-colors">
                        {{ $item->name }}
                    </h3>
                    {{-- Badge Waktu: Aksen Emas --}}
                    <div class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-50 rounded-full border border-amber-100 text-sm text-amber-700 font-medium">
                        <i class="bi bi-clock-fill text-amber-500"></i>
                        {{ $item->time }}
                    </div>
                </div>
            </div>

        @empty
            {{-- TAMPILAN JIKA DATA KOSONG --}}
            <div class="col-span-full text-center py-12" data-aos="fade-up">
                 {{-- Placeholder: Ikon Aksen Emas --}}
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-amber-100 mb-4 animate-pulse">
                    <i class="bi bi-stars text-4xl text-amber-500"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-600 mb-1">Akan Segera Hadir</h3>
                <p class="text-slate-400 text-sm">Daftar pengisi acara akan segera diupdate.</p>
            </div>
        @endforelse

    </div>

</div>