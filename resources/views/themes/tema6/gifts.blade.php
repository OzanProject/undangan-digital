<div id="gifts" class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-violet-700 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Tanda Kasih
        </span>
        {{-- Font Serif Elegan --}}
        <h2 class="font-serif-elegan text-4xl md:text-5xl text-slate-800 mt-2">
            Kirim Hadiah
        </h2>
        <p class="text-slate-600 mt-3 font-light">
            Tanpa mengurangi rasa hormat, bagi yang ingin memberikan tanda kasih, dapat melalui:
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-6 md:gap-8">

        {{-- BANK 1 (Deep Violet Theme) --}}
        @if($event->bank_name_1)
        <div class="relative w-full max-w-md group perspective" data-aos="flip-up" data-aos-delay="100">
            {{-- Gradient Violet/Dark --}}
            <div class="relative h-56 bg-gradient-to-br from-violet-700 via-violet-800 to-slate-900 rounded-2xl shadow-xl text-white p-6 flex flex-col justify-between overflow-hidden border border-violet-600/50 transition-transform duration-500 group-hover:-translate-y-2">
                
                {{-- Pattern Overlay --}}
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                
                {{-- Header Kartu --}}
                <div class="relative flex justify-between items-start z-10">
                    <div class="text-lg font-bold tracking-wider uppercase opacity-90">
                        {{ $event->bank_name_1 }}
                    </div>
                    <i class="bi bi-wifi text-2xl opacity-70 rotate-90"></i>
                </div>

                {{-- Chip & Nomor --}}
                <div class="relative z-10 mt-2">
                    {{-- Chip: Pink Pucat --}}
                    <div class="w-12 h-9 bg-gradient-to-tr from-pink-300 to-pink-500 rounded mb-4 opacity-90 flex items-center justify-center">
                        <div class="w-full h-px bg-black/20"></div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <p class="font-mono text-2xl md:text-3xl tracking-widest text-shadow-sm" id="rek1">
                            {{ $event->bank_acc_1 }}
                        </p>
                        {{-- Tombol Copy: Aksen Pink Muda --}}
                        <button 
                            type="button"
                            onclick="copyToClipboard('rek1', this)" 
                            class="text-pink-300 hover:text-white transition-colors" 
                            title="Salin Nomor"
                        >
                            <i class="bi bi-copy"></i>
                        </button>
                    </div>
                </div>

                {{-- Footer Kartu --}}
                <div class="relative flex justify-between items-end z-10">
                    <div>
                        <p class="text-[10px] text-pink-300 uppercase tracking-widest mb-0.5">Card Holder</p>
                        <p class="font-medium tracking-wide uppercase text-sm md:text-base">
                            {{ $event->bank_holder_1 }}
                        </p>
                    </div>
                    <div class="text-2xl opacity-80">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>
                </div>

            </div>
        </div>
        @endif

        {{-- BANK 2 (Light Lavender/Pink Theme) --}}
        @if($event->bank_name_2)
        <div class="relative w-full max-w-md group perspective" data-aos="flip-up" data-aos-delay="200">
            {{-- Latar Belakang Pink/Lavender Terang --}}
            <div class="relative h-56 bg-gradient-to-br from-pink-100 via-pink-200 to-violet-300 rounded-2xl shadow-xl text-slate-800 p-6 flex flex-col justify-between overflow-hidden border border-violet-300 transition-transform duration-500 group-hover:-translate-y-2">
                
                {{-- Header Kartu --}}
                <div class="relative flex justify-between items-start z-10">
                    <div class="text-lg font-bold tracking-wider uppercase opacity-90">
                        {{ $event->bank_name_2 }}
                    </div>
                    <i class="bi bi-wifi text-2xl opacity-70 rotate-90"></i>
                </div>

                {{-- Chip & Nomor --}}
                <div class="relative z-10 mt-2">
                    <div class="w-12 h-9 bg-gradient-to-tr from-slate-400 to-slate-300 rounded mb-4 opacity-90"></div>
                    
                    <div class="flex items-center gap-3">
                        <p class="font-mono text-2xl md:text-3xl tracking-widest text-shadow-sm" id="rek2">
                            {{ $event->bank_acc_2 }}
                        </p>
                        {{-- Tombol Copy: Aksen Violet Tua --}}
                        <button 
                            type="button"
                            onclick="copyToClipboard('rek2', this)" 
                            class="text-violet-600 hover:text-violet-800 transition-colors" 
                            title="Salin Nomor"
                        >
                            <i class="bi bi-copy"></i>
                        </button>
                    </div>
                </div>

                {{-- Footer Kartu --}}
                <div class="relative flex justify-between items-end z-10">
                    <div>
                        <p class="text-[10px] text-violet-600 uppercase tracking-widest mb-0.5">Card Holder</p>
                        <p class="font-medium tracking-wide uppercase text-sm md:text-base">
                            {{ $event->bank_holder_2 }}
                        </p>
                    </div>
                    <div class="text-2xl opacity-80">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>
</div>