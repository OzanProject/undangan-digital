@php
    // Logika tetap sama (mengambil data gallery)
    $galleries = \App\Models\Gallery::latest()->get();
@endphp

<div class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-primary-600 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Momen Bahagia
        </span>
        <h2 class="font-esthetic text-4xl md:text-5xl text-slate-800 mt-2">
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
                       class="block w-full aspect-square overflow-hidden rounded-2xl shadow-md cursor-pointer bg-slate-200 relative">
                        
                        {{-- Image --}}
                        <img src="{{ asset('storage/'.$img->image) }}" 
                             alt="Foto {{ $loop->iteration }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             loading="lazy">
                        
                        {{-- Overlay Hover Effect --}}
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/50 transform scale-0 group-hover:scale-100 transition-transform duration-300 delay-75">
                                <i class="bi bi-zoom-in text-xl"></i>
                            </div>
                        </div>

                        {{-- Caption (Optional: Muncul kecil di bawah saat hover) --}}
                        @if($img->caption)
                            <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/80 to-transparent text-white text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0">
                                {{ Str::limit($img->caption, 30) }}
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach

        </div>
    @else
        {{-- Empty State (Jika belum ada foto) --}}
        <div class="text-center py-12 bg-slate-50 rounded-3xl border border-dashed border-slate-300" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                <i class="bi bi-images text-3xl text-slate-400"></i>
            </div>
            <h3 class="text-lg font-medium text-slate-600">Belum ada foto galeri</h3>
            <p class="text-slate-400 text-sm mt-1">Foto momen bahagia akan segera diupload.</p>
        </div>
    @endif

</div>