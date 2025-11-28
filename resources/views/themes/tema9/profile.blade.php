<div id="mempelai" class="container mx-auto px-4 relative z-10">

    {{-- Header Teks (Bismillah / Intro) --}}
    <div class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up">
        <span class="text-amber-800 font-bold tracking-wider uppercase text-xs md:text-sm mb-2 block">
            Tasyakur Khitan
        </span>
        {{-- Font Serif Classic --}}
        <h2 class="font-serif-classic text-4xl md:text-5xl text-stone-800 mt-2 mb-6">
            Ananda Tercinta
        </h2>
        <p class="text-stone-600 leading-relaxed font-light md:text-lg">
            Dengan memohon Rahmat dan Ridho Allah SWT, kami bermaksud menyelenggarakan syukuran khitanan putra kami yang tercinta:
        </p>
    </div>

    {{-- Profile Card (Elegan dengan Layered Shadow) --}}
    <div class="relative max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
        
        {{-- Background Pattern (Hiasan Layer 1: Warna Krem Transparan) --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-amber-100/50 rounded-[3rem] shadow-xl rotate-1 z-0 opacity-70 scale-95"></div>
        {{-- Background Pattern (Hiasan Layer 2: Warna Putih/Netral) --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-white rounded-[3rem] shadow-2xl -rotate-1 z-0 opacity-80 scale-95"></div>

        {{-- Main Card Content --}}
        <div class="relative z-10 bg-white rounded-[2.5rem] shadow-2xl p-8 md:p-12 text-center border border-amber-50">
            
            {{-- Foto Anak --}}
            <div class="relative inline-block mb-8">
                {{-- Lingkaran Dekorasi di belakang foto (Aksen Krem) --}}
                <div class="absolute inset-0 bg-amber-100/70 rounded-full scale-110 animate-pulse-slow"></div> 
                
                <div class="relative p-2 bg-white rounded-full shadow-md">
                    @if($event->child_photo)
                        <img src="{{ asset('storage/'.$event->child_photo) }}" 
                            alt="Foto {{ $event->child_name }}"
                            {{-- Border Krem Muda --}}
                            class="w-48 h-48 md:w-64 md:h-64 rounded-full object-cover border-4 border-amber-300 shadow-inner"
                            loading="lazy">
                    @else
                        {{-- Placeholder jika tidak ada foto --}}
                        <div class="w-48 h-48 md:w-64 md:h-64 rounded-full bg-stone-200 flex items-center justify-center border-4 border-amber-300 text-stone-400">
                            <i class="bi bi-person-fill text-6xl"></i>
                        </div>
                    @endif
                </div>

                {{-- Ikon Hiasan kecil (Aksen Coklat Tua) --}}
                <div class="absolute bottom-2 right-2 bg-amber-900 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                    <i class="bi bi-heart-fill text-sm"></i>
                </div>
            </div>

            {{-- Nama & Orang Tua --}}
            <div class="space-y-4">
                {{-- Nama Anak (Font Serif Classic & Aksen Coklat Tua) --}}
                <h3 class="font-serif-classic text-5xl md:text-6xl text-amber-900 drop-shadow-sm">
                    {{ $event->child_name }}
                </h3>

                <div class="flex items-center justify-center gap-3 text-stone-500 my-4">
                    {{-- Garis Pemisah Krem --}}
                    <span class="h-px w-12 bg-amber-300"></span>
                    <span class="font-serif-classic italic text-lg text-stone-600">Putra dari</span>
                    <span class="h-px w-12 bg-amber-300"></span>
                </div>

                {{-- Nama Orang Tua --}}
                <div class="text-xl md:text-2xl font-bold text-stone-800">
                    {{ $event->parent_names }}
                </div>

                {{-- BAGIAN TURUT MENGUNDANG --}}
                @if(!empty($event->turut_mengundang_ayah) || !empty($event->turut_mengundang_ibu))
                    
                    <div class="mt-10 pt-8 border-t border-dashed border-amber-200 w-full max-w-2xl mx-auto">
                        <p class="text-xs font-bold text-amber-800 uppercase tracking-[0.2em] mb-6">
                            Turut Mengundang
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 text-center md:text-left">
                            
                            {{-- Kolom Ayah --}}
                            @if(!empty($event->turut_mengundang_ayah))
                            <div>
                                <h4 class="font-semibold text-amber-900 mb-3 text-base uppercase tracking-wide">
                                    Kel. Besar Bapak
                                </h4>
                                
                                @php
                                    $names = explode("\n", $event->turut_mengundang_ayah);
                                    $cleanNames = array_filter($names, 'trim'); 
                                    $count = count($cleanNames);
                                    $midpoint = (int) ceil($count / 2);
                                @endphp

                                @if ($count > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 text-sm md:text-base">
                                    <ul class="list-none p-0 m-0 text-stone-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, 0, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <ul class="list-none p-0 m-0 text-stone-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                    <p class="text-xs text-stone-500">Tidak ada keluarga yang dicantumkan.</p>
                                @endif

                            </div>
                            @endif

                            {{-- Kolom Ibu --}}
                            @if(!empty($event->turut_mengundang_ibu))
                            <div>
                                <h4 class="font-semibold text-amber-900 mb-3 text-base uppercase tracking-wide">
                                    Kel. Besar Ibu
                                </h4>
                                
                                @php
                                    $names = explode("\n", $event->turut_mengundang_ibu);
                                    $cleanNames = array_filter($names, 'trim');
                                    $count = count($cleanNames);
                                    $midpoint = (int) ceil($count / 2);
                                @endphp

                                @if ($count > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 text-sm md:text-base">
                                    <ul class="list-none p-0 m-0 text-stone-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, 0, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <ul class="list-none p-0 m-0 text-stone-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                    <p class="text-xs text-stone-500">Tidak ada keluarga yang dicantumkan.</p>
                                @endif

                            </div>
                            @endif

                        </div>
                    </div>
                @endif

            </div>

            {{-- Alamat (Aksen Hover Coklat) --}}
            <div class="mt-10 inline-flex items-center justify-center gap-2 px-6 py-3 bg-amber-100 rounded-full border border-amber-300 text-sm md:text-base text-stone-600 hover:bg-amber-200 hover:border-amber-400 hover:text-amber-800 transition-colors cursor-default group">
                <i class="bi bi-geo-alt-fill text-amber-800 group-hover:scale-110 transition-transform"></i>
                <span>{{ $event->location_address }}</span>
            </div>

        </div>
    </div>
</div>

<style>
    /* Custom Animation untuk pulse yang lebih lambat dan elegan (Diulang dari atas untuk kelengkapan) */
    @keyframes pulse-slow {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.6;
        }
    }
    .animate-pulse-slow {
        animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>