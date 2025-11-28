@php
    // 1. SET BAHASA INDONESIA (PENTING)
    \Carbon\Carbon::setLocale('id');

    // 2. Siapkan Data Waktu
    $startTime = $event->event_date; 
    $endTime   = $event->event_date->copy()->addHours(3); 
    
    // 3. Link Google Calendar
    $googleUrl = "https://www.google.com/calendar/render?action=TEMPLATE";
    $googleUrl .= "&text=" . urlencode("Syukuran Khitan: " . $event->child_name);
    $googleUrl .= "&dates=" . $startTime->format('Ymd\THis') . "/" . $endTime->format('Ymd\THis');
    $googleUrl .= "&details=" . urlencode("Mohon doa restu untuk khitanan putra kami. Lokasi: " . $event->location_name);
    $googleUrl .= "&location=" . urlencode($event->location_name . ", " . $event->location_address);
    $googleUrl .= "&ctz=Asia/Jakarta"; 

    // 4. Link ICS (Apple/Outlook)
    $icsContent  = "BEGIN:VCALENDAR\r\n";
    $icsContent .= "VERSION:2.0\r\n";
    $icsContent .= "PRODID:-//Khitanan//EN\r\n";
    $icsContent .= "BEGIN:VEVENT\r\n";
    $icsContent .= "UID:" . uniqid() . "@khitanan.com\r\n";
    $icsContent .= "DTSTAMP:" . date('Ymd\THis') . "\r\n";
    $icsContent .= "DTSTART:" . $startTime->format('Ymd\THis') . "\r\n";
    $icsContent .= "DTEND:" . $endTime->format('Ymd\THis') . "\r\n";
    $icsContent .= "SUMMARY:Syukuran Khitan " . $event->child_name . "\r\n";
    $icsContent .= "DESCRIPTION:Mohon doa restu untuk khitanan putra kami.\r\n";
    $icsContent .= "LOCATION:" . $event->location_name . "\r\n";
    $icsContent .= "END:VEVENT\r\n";
    $icsContent .= "END:VCALENDAR";

    $icsLink = "data:text/calendar;charset=utf8;base64," . base64_encode($icsContent);
@endphp
<div id="acara" class="container mx-auto px-4">
    
    {{-- Title Section --}}
    <div class="text-center mb-12" data-aos="fade-up">
        {{-- Aksen Emas Tua --}}
        <span class="text-amber-700 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">
            Save The Date
        </span>
        {{-- Font Classic --}}
        <h2 class="font-serif-classic text-4xl md:text-5xl text-slate-800 mt-2">
            Waktu & Tempat
        </h2>
    </div>

    {{-- Main Card --}}
    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-amber-50 flex flex-col md:flex-row" 
        data-aos="fade-up" data-aos-delay="100">
        
        {{-- Kiri: Detail Informasi --}}
        <div class="w-full md:w-5/12 p-8 md:p-10 flex flex-col justify-center bg-white relative z-10">
            
            {{-- Header Card --}}
            <h3 class="font-serif-classic text-3xl text-amber-800 mb-8 text-center md:text-left">
                Syukuran Khitan
            </h3>

            <div class="space-y-8">
                
                {{-- Item 1: Tanggal --}}
                <div class="flex items-start gap-4">
                    {{-- Ikon: Aksen Emas Tua --}}
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shadow-inner shadow-amber-200/50">
                        <i class="bi bi-calendar-heart-fill text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium uppercase tracking-wider mb-1">Hari & Tanggal</p>
                        <p class="text-lg font-bold text-slate-800 capitalize">
                            {{ $event->event_date->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>
                </div>

                {{-- Item 2: Waktu --}}
                <div class="flex items-start gap-4">
                    {{-- Ikon: Aksen Emas Tua --}}
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shadow-inner shadow-amber-200/50">
                        <i class="bi bi-alarm-fill text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium uppercase tracking-wider mb-1">Pukul</p>
                        <p class="text-lg font-bold text-slate-800">
                            {{ $event->event_date->format('H:i') }} WIB - Selesai
                        </p>
                    </div>
                </div>

                {{-- Item 3: Lokasi --}}
                <div class="flex items-start gap-4">
                    {{-- Ikon: Aksen Emas Tua --}}
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shadow-inner shadow-amber-200/50">
                        <i class="bi bi-geo-alt-fill text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium uppercase tracking-wider mb-1">Lokasi Acara</p>
                        <p class="text-lg font-bold text-slate-800 leading-tight mb-1">
                            {{ $event->location_name }}
                        </p>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            {{ $event->location_address }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- AREA TOMBOL --}}
            <div class="mt-10 space-y-3">
                
                {{-- 1. Tombol Google Maps (Aksen Emas Tua) --}}
                <a href="https://maps.google.com/?q={{ urlencode($event->location_name . ' ' . $event->location_address) }}" 
                    target="_blank"
                    class="block w-full text-center py-3 px-6 rounded-xl bg-amber-800 text-white font-semibold shadow-xl shadow-amber-900/40 hover:bg-amber-700 hover:shadow-2xl transition-all transform hover:-translate-y-0.5 group">
                    <i class="bi bi-map-fill me-2 group-hover:animate-bounce"></i> 
                    Buka Google Maps
                </a>

                {{-- Divider Kecil --}}
                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-slate-200"></div>
                    <span class="flex-shrink-0 mx-4 text-slate-500 text-xs uppercase font-bold">Simpan Tanggal</span>
                    <div class="flex-grow border-t border-slate-200"></div>
                </div>

                {{-- 2. Tombol Add to Calendar (Aksen Emas) --}}
                <div class="grid grid-cols-2 gap-3">
                    {{-- Google Calendar --}}
                    <a href="{!! $googleUrl !!}" target="_blank"
                        class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-white border border-slate-200 text-slate-600 text-sm font-bold hover:bg-amber-50 hover:text-amber-800 hover:border-amber-200 transition-all">
                        <i class="bi bi-google"></i> Google
                    </a>

                    {{-- Apple / Outlook (.ics) --}}
                    <a href="{!! $icsLink !!}" download="undangan-{{ Str::slug($event->child_name) }}.ics"
                        class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-white border border-slate-200 text-slate-600 text-sm font-bold hover:bg-amber-50 hover:text-amber-800 hover:border-amber-200 transition-all">
                        <i class="bi bi-apple"></i> Apple/Other
                    </a>
                </div>

            </div>

        </div>

        {{-- Kanan: Peta (Full Height) --}}
        <div class="w-full md:w-7/12 h-80 md:h-auto relative bg-slate-100">
            @if($event->maps_iframe)
                <iframe 
                    src="{{ $event->maps_iframe }}" 
                    {{-- Filter grayscale dan hover/transition untuk kesan premium --}}
                    class="w-full h-full border-0 filter grayscale hover:grayscale-0 transition-all duration-700" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 space-y-2 p-6 text-center">
                    <i class="bi bi-map-fill text-4xl opacity-50"></i>
                    <span>Peta belum disetting oleh admin.</span>
                </div>
            @endif
            
            <div class="absolute top-0 bottom-0 left-0 w-16 bg-gradient-to-r from-white to-transparent hidden md:block pointer-events-none"></div>
        </div>

    </div>
</div>