<section 
    id="hero" 
    class="hero-bg relative w-full h-screen overflow-hidden"
>
    {{-- Overlay Gelap/Netral untuk kontras Violet/Pink --}}
    <div class="absolute inset-0 bg-slate-900/60 bg-gradient-to-b from-slate-900/80 via-slate-900/40 to-slate-900/80 z-0"></div>

    {{-- MAIN CONTENT: teks + countdown --}}
    <main 
        class="relative z-10 w-full h-full max-w-4xl mx-auto 
                flex flex-col items-center justify-center 
                px-4 pt-6 pb-28 md:pb-32 gap-3 md:gap-5"
    >
        {{-- A. Guest Name Badge --}}
        <div data-aos="fade-down" data-aos-duration="1000" class="w-full text-center mt-1">
            <p class="text-pink-300 text-[10px] md:text-xs font-medium tracking-[0.3em] uppercase mb-2">
                Kepada Yth. Bapak/Ibu/Saudara/i
            </p>
            
            {{-- Badge: background transparan gelap dengan border pink lembut --}}
            <div class="inline-block bg-slate-800/50 backdrop-blur-sm border border-pink-300/50 rounded-full px-6 py-2 shadow-2xl">
                <h2 class="text-base md:text-lg font-semibold text-white tracking-wide">
                    {{ $guestName ?? 'Tamu Undangan' }}
                </h2>
            </div>
        </div>

        {{-- B. Intro & Nama Anak --}}
        <div class="w-full px-2 text-center">
            <p class="text-white/80 text-[11px] md:text-sm font-light max-w-lg mx-auto leading-relaxed mb-1" 
                data-aos="fade-up" 
                data-aos-delay="200">
                Dengan memohon Rahmat & Ridho Allah SWT, kami bermaksud menyelenggarakan syukuran khitan putra kami:
            </p>

            {{-- Nama: Font Serif Elegan dan Aksen Pink/Violet --}}
            <h1 class="font-serif-elegan text-4xl md:text-5xl lg:text-6xl text-pink-300 mt-2 mb-3 md:mb-5 drop-shadow-2xl" 
                data-aos="zoom-in" 
                data-aos-delay="400"
                {{-- Efek shadow Violet/Pink lembut --}}
                style="text-shadow: 0 0 20px rgba(255, 192, 203, 0.6); line-height: 1.1; font-weight: 500;"
            >
                {{ $event->child_name }}
            </h1>
        </div>

        {{-- C. Countdown --}}
        <div class="w-full flex justify-center z-20" data-aos="fade-up" data-aos-delay="600">
            <div class="simply-countdown custom-countdown"></div>
        </div>
    </main>

    {{-- D. TOMBOL BUKA UNDANGAN (Aksen Violet Tua) --}}
    <div class="absolute inset-x-0 bottom-6 flex justify-center z-20 px-4">
        <a 
            href="#mempelai"
            onclick="enableScroll()"
            class="btn-buka btn-buka-enter group relative inline-flex items-center justify-center 
                    px-7 py-3 md:px-9 md:py-3.5 text-sm font-bold text-white 
                    transition-all duration-300 bg-violet-800 rounded-full 
                    hover:bg-violet-700 hover:shadow-[0_0_25px_rgba(109,40,217,0.6)] 
                    hover:-translate-y-1 active:scale-95 shadow-xl shadow-violet-900/50"
        >
            <span class="absolute inset-0 rounded-full bg-white/30 group-hover:animate-ping opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
            <i class="bi bi-envelope-open-heart me-2 text-lg"></i>
            <span>Buka Undangan</span>
        </a>
    </div>
</section>