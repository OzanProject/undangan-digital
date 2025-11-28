<footer class="relative bg-slate-900 pt-24 pb-12 overflow-hidden">
    
    {{-- Efek Cahaya Latar Belakang (Glow Effect) --}}
    {{-- Mengganti green-600/10 menjadi amber-600/10 --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-lg h-48 bg-amber-600/10 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-4 text-center relative z-10">

        {{-- Penutup Salam --}}
        <div class="mb-8" data-aos="fade-up">
            <p class="text-slate-400 text-xs md:text-sm tracking-[0.3em] uppercase mb-4">
                Wassalamu'alaikum Wr. Wb.
            </p>
            
            {{-- Nama Anak (Font Classic) --}}
            <h2 class="font-serif-classic text-5xl md:text-7xl text-white drop-shadow-lg mb-2">
                {{ $event->child_name }}
            </h2>
            
            <p class="text-slate-500 font-light text-sm italic mt-2">
                Terima kasih atas doa & restu Bapak/Ibu/Saudara/i.
            </p>
        </div>

        {{-- Garis Pemisah (Aksen Emas di tengah) --}}
        <div class="w-full max-w-xs mx-auto h-px bg-gradient-to-r from-transparent via-amber-700 to-transparent my-8"></div>

        {{-- Copyright & Keluarga --}}
        <div class="text-slate-600 text-sm font-light" data-aos="fade-up" data-aos-delay="100">
            <p class="mb-1">
                &copy; {{ date('Y') }} Keluarga Besar
            </p>
            <p class="text-slate-300 font-medium text-base">
                {{ $event->parent_names }}
            </p>
        </div>

    </div>
</footer>