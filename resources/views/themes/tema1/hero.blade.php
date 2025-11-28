<section 
    id="hero" 
    class="hero-bg relative w-full h-screen overflow-hidden"
>
    {{-- Overlay gelap --}}
    <div class="absolute inset-0 bg-slate-900/60 bg-gradient-to-b from-slate-900/90 via-slate-900/40 to-slate-900/90 z-0"></div>

    {{-- MAIN CONTENT: teks + countdown (tanpa tombol) --}}
    <main 
        class="relative z-10 w-full h-full max-w-4xl mx-auto 
               flex flex-col items-center justify-center 
               px-4 pt-6 pb-28 md:pb-32 gap-3 md:gap-5"
    >
        {{-- A. Guest Name Badge --}}
        <div data-aos="fade-down" data-aos-duration="1000" class="w-full text-center mt-1">
            <p class="text-slate-300 text-[10px] md:text-xs font-medium tracking-[0.3em] uppercase mb-2">
                Kepada Yth. Bapak/Ibu/Saudara/i
            </p>
            
            <div class="inline-block bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-5 py-2 shadow-2xl">
                <h2 class="text-base md:text-lg font-bold text-white tracking-wide">
                    {{ $guestName ?? 'Tamu Undangan' }}
                </h2>
            </div>
        </div>

        {{-- B. Intro & Nama Anak --}}
        <div class="w-full px-2 text-center">
            <p class="text-slate-200 text-[11px] md:text-sm font-light max-w-lg mx-auto leading-relaxed opacity-90 mb-1" 
               data-aos="fade-up" 
               data-aos-delay="200">
                Dengan memohon Rahmat &amp; Ridho Allah SWT, kami bermaksud menyelenggarakan syukuran khitan putra kami:
            </p>

            <h1 class="font-esthetic text-4xl md:text-6xl lg:text-7xl text-sky-300 mt-1 mb-1 md:mb-3 drop-shadow-2xl" 
                data-aos="zoom-in" 
                data-aos-delay="400"
                style="text-shadow: 0 0 25px rgba(125, 211, 252, 0.6); line-height: 1.2;">
                {{ $event->child_name }}
            </h1>
        </div>

        {{-- C. Countdown --}}
        <div class="w-full flex justify-center z-20" data-aos="fade-up" data-aos-delay="600">
            <div class="simply-countdown custom-countdown"></div>
        </div>
    </main>

    {{-- D. TOMBOL BUKA UNDANGAN – TANPA AOS, pakai animasi custom --}}
    <div class="absolute inset-x-0 bottom-6 flex justify-center z-20 px-4">
        <a 
            href="#mempelai"
            onclick="enableScroll()"
            class="btn-buka btn-buka-enter group relative inline-flex items-center justify-center 
                   px-6 py-2.5 md:px-8 md:py-3 text-sm font-bold text-white 
                   transition-all duration-300 bg-primary-600 rounded-full 
                   hover:bg-primary-500 hover:shadow-[0_0_25px_rgba(14,165,233,0.6)] 
                   hover:-translate-y-1 active:scale-95 shadow-lg shadow-primary-900/50"
        >
            <span class="absolute inset-0 rounded-full bg-white/30 group-hover:animate-ping opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
            <i class="bi bi-envelope-open-heart me-2 text-lg"></i>
            <span>Buka Undangan</span>
        </a>
    </div>
</section>
