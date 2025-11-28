<div id="mempelai" class="container mx-auto px-4 relative z-10">

    {{-- Header Teks (Bismillah / Intro) --}}
    <div class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up">
        {{-- Aksen Hijau Tua --}}
        <span class="text-green-700 font-bold tracking-wider uppercase text-xs md:text-sm mb-2 block">
            Tasyakur Khitan
        </span>
        {{-- Font Elegan --}}
        <h2 class="font-serif-elegan text-4xl md:text-5xl text-slate-800 mb-6">
            Ananda Tercinta
        </h2>
        <p class="text-slate-600 leading-relaxed font-light md:text-lg">
            Dengan memohon Rahmat dan Ridho Allah SWT, kami bermaksud menyelenggarakan syukuran khitanan putra kami yang tercinta:
        </p>
    </div>

    {{-- Profile Card (Elegan dengan Layered Shadow) --}}
    <div class="relative max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
        
        {{-- Background Pattern (Hiasan Layer 1: Warna Hijau Muda Transparan) --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-green-100/50 rounded-[3rem] shadow-xl rotate-1 z-0 opacity-70 scale-95"></div>
        {{-- Background Pattern (Hiasan Layer 2: Warna Putih/Netral) --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-white rounded-[3rem] shadow-2xl -rotate-1 z-0 opacity-80 scale-95"></div>

        {{-- Main Card Content --}}
        <div class="relative z-10 bg-white rounded-[2.5rem] shadow-2xl p-8 md:p-12 text-center border border-green-50">
            
            {{-- Foto Anak --}}
            <div class="relative inline-block mb-8">
                {{-- Lingkaran Dekorasi di belakang foto (Aksen Hijau) --}}
                <div class="absolute inset-0 bg-green-100/70 rounded-full scale-110 animate-pulse-slow"></div> 
                
                <div class="relative p-2 bg-white rounded-full shadow-lg">
                    @if($event->child_photo)
                        <img src="{{ asset('storage/'.$event->child_photo) }}" 
                            alt="Foto {{ $event->child_name }}"
                            {{-- Border Hijau Muda --}}
                            class="w-48 h-48 md:w-64 md:h-64 rounded-full object-cover border-4 border-green-200 shadow-inner"
                            loading="lazy">
                    @else
                        {{-- Placeholder jika tidak ada foto --}}
                        <div class="w-48 h-48 md:w-64 md:h-64 rounded-full bg-slate-100 flex items-center justify-center border-4 border-green-200 text-slate-300">
                            <i class="bi bi-person-fill text-6xl"></i>
                        </div>
                    @endif
                </div>

                {{-- Ikon Hiasan kecil (Aksen Hijau Tua) --}}
                <div class="absolute bottom-2 right-2 bg-green-800 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                    <i class="bi bi-heart-fill text-sm"></i>
                </div>
            </div>

            {{-- Nama & Orang Tua --}}
            <div class="space-y-4">
                {{-- Nama Anak (Font Elegan & Aksen Hijau Tua) --}}
                <h3 class="font-serif-elegan text-5xl md:text-6xl text-green-800 drop-shadow-sm">
                    {{ $event->child_name }}
                </h3>

                <div class="flex items-center justify-center gap-3 text-slate-500 my-4">
                    {{-- Garis Pemisah lebih lembut --}}
                    <span class="h-px w-12 bg-green-200"></span>
                    <span class="font-serif italic text-lg text-slate-600">Putra dari</span>
                    <span class="h-px w-12 bg-green-200"></span>
                </div>

                {{-- Nama Orang Tua --}}
                <div class="text-xl md:text-2xl font-bold text-slate-800">
                    {{ $event->parent_names }}
                </div>

                {{-- BAGIAN TURUT MENGUNDANG --}}
                @if(!empty($event->turut_mengundang_ayah) || !empty($event->turut_mengundang_ibu))
                    
                    <div class="mt-10 pt-8 border-t border-dashed border-green-200 w-full max-w-2xl mx-auto">
                        <p class="text-xs font-bold text-green-700 uppercase tracking-[0.2em] mb-6">
                            Turut Mengundang
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 text-center md:text-left">
                            
                            {{-- Kolom Ayah --}}
                            @if(!empty($event->turut_mengundang_ayah))
                            <div>
                                <h4 class="font-semibold text-green-800 mb-3 text-base uppercase tracking-wide">
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
                                    <ul class="list-none p-0 m-0 text-slate-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, 0, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <ul class="list-none p-0 m-0 text-slate-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                    <p class="text-xs text-slate-400">Tidak ada keluarga yang dicantumkan.</p>
                                @endif

                            </div>
                            @endif

                            {{-- Kolom Ibu --}}
                            @if(!empty($event->turut_mengundang_ibu))
                            <div>
                                <h4 class="font-semibold text-green-800 mb-3 text-base uppercase tracking-wide">
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
                                    <ul class="list-none p-0 m-0 text-slate-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, 0, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <ul class="list-none p-0 m-0 text-slate-700 font-medium space-y-1">
                                        @foreach(array_slice($cleanNames, $midpoint) as $nama)
                                            @if(trim($nama)) 
                                                <li class="capitalize">{{ $nama }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                    <p class="text-xs text-slate-400">Tidak ada keluarga yang dicantumkan.</p>
                                @endif

                            </div>
                            @endif

                        </div>
                    </div>
                @endif

            </div>

            {{-- Alamat (Aksen Hover Hijau) --}}
            <div class="mt-10 inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 rounded-full border border-slate-200 text-sm md:text-base text-slate-600 hover:bg-green-50 hover:border-green-200 hover:text-green-700 transition-colors cursor-default group">
                {{-- Icon Merah menjadi Hijau Tua --}}
                <i class="bi bi-geo-alt-fill text-green-600 group-hover:scale-110 transition-transform"></i>
                <span>{{ $event->location_address }}</span>
            </div>

        </div>
    </div>
</div>

<style>
    /* Custom Animation untuk pulse yang lebih lambat dan elegan */
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