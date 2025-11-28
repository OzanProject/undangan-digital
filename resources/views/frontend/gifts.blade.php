<div class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-primary-600 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Tanda Kasih
        </span>
        <h2 class="font-esthetic text-4xl md:text-5xl text-slate-800 mt-2">
            Kirim Hadiah
        </h2>
        <p class="text-slate-500 mt-3 font-light">
            Tanpa mengurangi rasa hormat, bagi yang ingin memberikan tanda kasih, dapat melalui:
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-6 md:gap-8">

        {{-- BANK 1 (Dark Premium Theme) --}}
        @if($event->bank_name_1)
        <div class="relative w-full max-w-md group perspective" data-aos="flip-up" data-aos-delay="100">
            <div class="relative h-56 bg-gradient-to-br from-slate-700 via-slate-800 to-black rounded-2xl shadow-2xl text-white p-6 flex flex-col justify-between overflow-hidden border border-slate-600/50 transition-transform duration-500 group-hover:-translate-y-2">
                
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
                    <div class="w-12 h-9 bg-gradient-to-tr from-yellow-200 to-yellow-500 rounded mb-4 opacity-90 flex items-center justify-center">
                        <div class="w-full h-px bg-black/20"></div>
                    </div>
                    
                    {{-- Nomor Rekening (Font Monospace agar seperti kartu asli) --}}
                    <div class="flex items-center gap-3">
                        <p class="font-mono text-2xl md:text-3xl tracking-widest text-shadow-sm" id="rek1">
                            {{ $event->bank_acc_1 }}
                        </p>
                        {{-- Tombol Copy Kecil di samping nomor --}}
                        <button 
                            type="button"
                            onclick="copyToClipboard('rek1', this)" 
                            class="text-slate-400 hover:text-white transition-colors" 
                            title="Salin Nomor"
                        >
                            <i class="bi bi-copy"></i>
                        </button>
                    </div>
                </div>

                {{-- Footer Kartu --}}
                <div class="relative flex justify-between items-end z-10">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest mb-0.5">Card Holder</p>
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

        {{-- BANK 2 (Purple/Blue Modern Theme) --}}
        @if($event->bank_name_2)
        <div class="relative w-full max-w-md group perspective" data-aos="flip-up" data-aos-delay="200">
            <div class="relative h-56 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-2xl text-white p-6 flex flex-col justify-between overflow-hidden border border-white/20 transition-transform duration-500 group-hover:-translate-y-2">
                
                {{-- Glass Overlay --}}
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/20 rounded-full blur-3xl"></div>
                
                {{-- Header Kartu --}}
                <div class="relative flex justify-between items-start z-10">
                    <div class="text-lg font-bold tracking-wider uppercase opacity-90">
                        {{ $event->bank_name_2 }}
                    </div>
                    <i class="bi bi-wifi text-2xl opacity-70 rotate-90"></i>
                </div>

                {{-- Chip & Nomor --}}
                <div class="relative z-10 mt-2">
                    <div class="w-12 h-9 bg-gradient-to-tr from-slate-300 to-slate-100 rounded mb-4 opacity-90"></div>
                    
                    <div class="flex items-center gap-3">
                        <p class="font-mono text-2xl md:text-3xl tracking-widest text-shadow-sm" id="rek2">
                            {{ $event->bank_acc_2 }}
                        </p>
                        <button 
                            type="button"
                            onclick="copyToClipboard('rek2', this)" 
                            class="text-indigo-200 hover:text-white transition-colors" 
                            title="Salin Nomor"
                        >
                            <i class="bi bi-copy"></i>
                        </button>
                    </div>
                </div>

                {{-- Footer Kartu --}}
                <div class="relative flex justify-between items-end z-10">
                    <div>
                        <p class="text-[10px] text-indigo-200 uppercase tracking-widest mb-0.5">Card Holder</p>
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
