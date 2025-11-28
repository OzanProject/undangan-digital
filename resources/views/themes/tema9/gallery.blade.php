@php
    // --- KODE INI WAJIB DITAMBAHKAN UNTUK MENGAMBIL DATA GALERI ---
    $galleries = \App\Models\Gallery::latest()->get(); 
@endphp

<div id="galeri" class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-amber-800 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Momen Bahagia
        </span>
        {{-- Font Serif Classic --}}
        <h2 class="font-serif-classic text-4xl md:text-5xl text-stone-800 mt-2">
            Galeri Foto
        </h2>
    </div>

    {{-- Grid Gallery --}}
    @if($galleries->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            
            @foreach($galleries as $img)
                <div class="relative group" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
                    
                    {{-- Link Lightbox --}}
                    <a href="{{ asset('storage/'.$img->image) }}" 
                        data-toggle="lightbox" 
                        data-gallery="mygallery" 
                        data-caption="{{ $img->caption }}"
                        {{-- Shadow dan border Krem --}}
                        class="block w-full aspect-square overflow-hidden rounded-xl shadow-md cursor-pointer bg-stone-200 relative border border-amber-300">
                        
                        {{-- Image --}}
                        <img src="{{ asset('storage/'.$img->image) }}" 
                            alt="Foto {{ $loop->iteration }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 group-hover:brightness-90"
                            loading="lazy">
                        
                        {{-- Overlay Hover Effect --}}
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm">
                            <div class="w-14 h-14 rounded-full bg-white/30 backdrop-blur-md flex items-center justify-center text-white border-2 border-white/80 transform scale-0 group-hover:scale-100 transition-transform duration-300 delay-75">
                                <i class="bi bi-zoom-in text-xl"></i>
                            </div>
                        </div>

                        {{-- Caption (Optional) --}}
                        @if($img->caption)
                            <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/60 to-transparent text-white text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0">
                                {{ Str::limit($img->caption, 30) }}
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach

        </div>
    @else
        {{-- Empty State (Aksen Coklat) --}}
        <div class="text-center py-12 bg-amber-100 rounded-3xl border border-dashed border-amber-300" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-200 mb-4">
                <i class="bi bi-images text-3xl text-amber-600"></i>
            </div>
            <h3 class="text-lg font-medium text-stone-700">Belum ada foto galeri</h3>
            <p class="text-stone-500 text-sm mt-1">Foto momen bahagia akan segera diupload.</p>
        </div>
    @endif

</div>