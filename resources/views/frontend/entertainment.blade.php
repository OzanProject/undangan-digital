<div class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-primary-600 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Rundown & Hiburan
        </span>
        <h2 class="font-esthetic text-4xl md:text-5xl text-slate-800 mt-2">
            Turut Dimeriahkan Oleh
        </h2>
    </div>

    {{-- Grid Content (Menggunakan grid yang sama dengan Galeri agar konsisten) --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 justify-center">
        
        @forelse($entertainments as $item)
            {{-- Card Wrapper --}}
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100" 
                 data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                
                {{-- 1. BAGIAN GAMBAR (GAYA GALERI + LIGHTBOX BAWAAN) --}}
                <div class="relative overflow-hidden h-64 bg-slate-200">
                    @if($item->image)
                        <a href="{{ asset('storage/'.$item->image) }}" 
                           data-toggle="lightbox" 
                           data-gallery="entertainment-gallery"
                           data-caption="{{ $item->name }} - {{ $item->type }}"
                           class="block w-full h-full relative cursor-zoom-in">
                            
                            {{-- Image: object-top agar wajah aman --}}
                            <img src="{{ asset('storage/'.$item->image) }}" 
                                 alt="{{ $item->name }}" 
                                 class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110"
                                 loading="lazy">
                            
                            {{-- Overlay Hover Effect (Persis seperti Galeri) --}}
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/50 transform scale-0 group-hover:scale-100 transition-transform duration-300 delay-75">
                                    <i class="bi bi-zoom-in text-xl"></i>
                                </div>
                            </div>
                        </a>
                    @else
                        {{-- Fallback jika tidak ada gambar --}}
                        <div class="w-full h-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white">
                            <i class="bi bi-music-note-beamed text-5xl opacity-50"></i>
                        </div>
                    @endif

                    {{-- Badge Type (Posisikan di atas gambar) --}}
                    <div class="absolute top-2 right-2 pointer-events-none">
                        <span class="bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg text-[10px] font-bold text-primary-600 shadow-sm uppercase tracking-wide">
                            {{ $item->type }}
                        </span>
                    </div>
                </div>

                {{-- 2. BAGIAN INFO (NAMA & JAM) --}}
                <div class="p-4 text-center bg-white relative z-10">
                    <h3 class="text-sm md:text-base font-bold text-slate-800 mb-1 leading-tight line-clamp-2" title="{{ $item->name }}">
                        {{ $item->name }}
                    </h3>
                    <div class="inline-flex items-center gap-1.5 mt-2 px-3 py-1 bg-slate-50 rounded-full border border-slate-100 text-[10px] md:text-xs text-slate-500 font-medium">
                        <i class="bi bi-clock-fill text-primary-400"></i>
                        {{ $item->time }}
                    </div>
                </div>
            </div>

        @empty
            {{-- State Kosong --}}
            <div class="col-span-full text-center py-12" data-aos="fade-up">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4 animate-pulse">
                    <i class="bi bi-stars text-3xl text-slate-400"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-600 mb-1">Akan Segera Hadir</h3>
                <p class="text-slate-400 text-sm">Daftar pengisi acara akan segera diupdate.</p>
            </div>
        @endforelse

    </div>

</div>