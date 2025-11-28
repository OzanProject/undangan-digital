<div id="entertainment" class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-cyan-500 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Rundown & Hiburan
        </span>
        {{-- Font Sans --}}
        <h2 class="font-sans text-4xl md:text-5xl text-slate-100 mt-2 font-extrabold">
            Turut Dimeriahkan Oleh
        </h2>
    </div>

    {{-- Grid Content --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
        
        {{-- Looping Data --}}
        @forelse($entertainments as $item)
            <div class="group relative bg-slate-800 rounded-2xl overflow-hidden shadow-xl border border-slate-700 hover:shadow-2xl hover:border-cyan-500/50 hover:-translate-y-2 transition-all duration-300" 
                 data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                
                {{-- Image Header --}}
                <div class="h-48 bg-slate-700 relative overflow-hidden">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        {{-- Placeholder: Aksen Gradient Cyan --}}
                        <div class="w-full h-full bg-gradient-to-br from-cyan-600 to-cyan-800 flex items-center justify-center text-white">
                            <i class="bi bi-music-note-beamed text-5xl opacity-70"></i>
                        </div>
                    @endif
                    
                    {{-- Badge Type (Aksen Cyan) --}}
                    <div class="absolute top-3 right-3 bg-slate-900/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-cyan-400 shadow-md">
                        {{ $item->type }}
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6 text-center">
                    {{-- Nama: Aksen Hover Cyan --}}
                    <h3 class="text-xl font-bold text-slate-100 mb-2 group-hover:text-cyan-400 transition-colors">
                        {{ $item->name }}
                    </h3>
                    {{-- Badge Waktu: Aksen Cyan --}}
                    <div class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-700 rounded-full border border-slate-600 text-sm text-cyan-400 font-medium">
                        <i class="bi bi-clock-fill text-cyan-500"></i>
                        {{ $item->time }}
                    </div>
                </div>
            </div>

        @empty
            {{-- TAMPILAN JIKA DATA KOSONG --}}
            <div class="col-span-full text-center py-12" data-aos="fade-up">
                 {{-- Placeholder: Ikon Aksen Cyan --}}
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-700 mb-4 animate-pulse">
                    <i class="bi bi-stars text-4xl text-cyan-500"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-300 mb-1">Akan Segera Hadir</h3>
                <p class="text-slate-500 text-sm">Daftar pengisi acara akan segera diupdate.</p>
            </div>
        @endforelse

    </div>

</div>