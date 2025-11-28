<section 
    id="hero" 
    class="hero-bg relative w-full h-screen overflow-hidden"
>
    {{-- Overlay Coklat Gelap/Hangat --}}
    <div class="absolute inset-0 bg-stone-900/60 bg-gradient-to-b from-stone-900/80 via-stone-900/40 to-stone-900/80 z-0"></div>

    {{-- MAIN CONTENT: teks + countdown --}}
    <main 
        class="relative z-10 w-full h-full max-w-4xl mx-auto 
                flex flex-col items-center justify-center 
                px-4 pt-6 pb-28 md:pb-32 gap-3 md:gap-5"
    >
        {{-- A. Guest Name Badge --}}
        <div data-aos="fade-down" data-aos-duration="1000" class="w-full text-center mt-1">
            <p class="text-amber-200 text-[10px] md:text-xs font-medium tracking-[0.3em] uppercase mb-2">
                Kepada Yth. Bapak/Ibu/Saudara/i
            </p>
            
            {{-- Badge: background transparan gelap dengan border krem lembut --}}
            <div class="inline-block bg-stone-800/50 backdrop-blur-sm border border-amber-200/50 rounded-full px-6 py-2 shadow-2xl">
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
                Dengan memohon Rahmat &amp; Ridho Allah SWT, kami bermaksud menyelenggarakan syukuran khitan putra kami:
            </p>

            {{-- Nama: Font Serif Classic dan Aksen Krem Hangat --}}
            <h1 class="font-serif-classic text-4xl md:text-5xl lg:text-6xl text-amber-300 mt-2 mb-3 md:mb-5 drop-shadow-2xl" 
                data-aos="zoom-in" 
                data-aos-delay="400"
                {{-- Efek shadow Coklat lembut --}}
                style="text-shadow: 0 0 15px rgba(251, 191, 36, 0.4); line-height: 1.1; font-weight: 500;"
            >
                {{ $event->child_name }}
            </h1>
        </div>

        {{-- C. Countdown --}}
        <div class="w-full flex justify-center z-20" data-aos="fade-up" data-aos-delay="600">
            <div class="simply-countdown custom-countdown"></div>
        </div>
    </main>

    {{-- D. TOMBOL BUKA UNDANGAN (Aksen Coklat Tua) --}}
    <div class="absolute inset-x-0 bottom-6 flex justify-center z-20 px-4">
        <a 
            href="#mempelai"
            onclick="enableScroll()"
            class="btn-buka btn-buka-enter group relative inline-flex items-center justify-center 
                    px-7 py-3 md:px-9 md:py-3.5 text-white 
                    transition-all duration-300 bg-amber-900 rounded-full 
                    hover:bg-amber-800 hover:shadow-[0_0_25px_rgba(180,83,9,0.6)] 
                    hover:-translate-y-1 active:scale-95 shadow-xl shadow-amber-900/50"
        >
            <span class="absolute inset-0 rounded-full bg-white/30 group-hover:animate-ping opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
            <i class="bi bi-envelope-open-heart me-2 text-lg"></i>
            <span>Buka Undangan</span>
        </a>
    </div>
</section>