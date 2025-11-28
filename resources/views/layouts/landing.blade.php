<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- Favicon (Dinamis dari Logo Perusahaan) --}}
    @if (!empty($event->logo_path))
        <link rel="shortcut icon" href="{{ asset('storage/' . $event->logo_path) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    {{-- SEO & Meta Tags --}}
    <title>Tasyakur Khitan {{ $event->child_name ?? 'Anak Sholeh' }}</title>
    <meta name="description" content="Undangan digital tasyakur khitan {{ $event->child_name }}. Kami mengundang Bapak/Ibu untuk hadir di acara istimewa ini.">
    <meta property="og:title" content="Tasyakur Khitan {{ $event->child_name }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ $event->hero_image ? asset('storage/'.$event->hero_image) : 'https://images.unsplash.com/photo-1519225468359-696330f999fc' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Sacramento&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 (Icons & Grid System) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    {{-- Libraries Styles --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplycountdown.js@1.5.0/simplyCountdown.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    {{-- TAILWIND CSS & Config --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        esthetic: ['"Sacramento"', 'cursive'],
                    },
                    colors: {
                        primary: { DEFAULT: '#0EA5E9', 50: '#F0F9FF', 600: '#0284C7' }
                    }
                }
            }
        }
    </script>

    {{-- Custom CSS & Helpers --}}
    <style type="text/tailwindcss">
        @layer utilities {
            .text-shadow { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); }
        }
        
        /* Scrollbar Modern */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        /* Global Hero Background Class (Dynamic via PHP) */
        .hero-bg {
            background-image: url("{{ $event->hero_image ? asset('storage/'.$event->hero_image) : 'https://images.unsplash.com/photo-1519225468359-696330f999fc' }}");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Countdown Style */
        .custom-countdown { 
            display: flex !important; 
            flex-direction: row !important; 
            justify-content: center; 
            gap: 10px; 
        }

        .simply-section {
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(5px); 
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 14px; 

            /* >>> ruang dalam biar angka gak nempel border <<< */
            width: 64px; 
            height: 72px; 
            padding: 6px 8px;
            box-sizing: border-box;

            display: flex !important; 
            flex-direction: column !important;
            align-items: center; 
            justify-content: center; 
            gap: 4px; /* jarak angka–label */

            margin: 0 !important; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .simply-amount { 
            font-size: 18px; 
            font-weight: 800; 
            color: white; 
            line-height: 1.1;  /* sedikit lebih tinggi dari 1 biar lega */
        }

        .simply-word { 
            font-size: 9px; 
            text-transform: uppercase; 
            color: #cbd5e1; 
            font-weight: 600; 
            letter-spacing: 0.05em;
        }
        
        @media (min-width: 768px) {
            .simply-section { 
                width: 90px; 
                height: 96px; 
                padding: 8px 10px;
                border-radius: 16px;
            }
            .simply-amount { font-size: 28px; }
            .simply-word   { font-size: 11px; }
        }

        [x-cloak] { display: none !important; }

        /* Animasi halus untuk tombol Buka Undangan (tanpa AOS) */
        @keyframes btnBukaIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .btn-buka-enter {
            opacity: 0;
            transform: translateY(10px);
            animation: btnBukaIn 0.6s ease-out 0.4s forwards;
        }

    </style>

</head>

<body class="antialiased text-slate-600 bg-slate-50 selection:bg-primary selection:text-white overflow-x-hidden" id="main-body">

    @yield('content')

    {{-- AUDIO PLAYER --}}
    <div id="audio-container">
        <audio id="song" loop>
            @if($event->audio_path)
                <source src="{{ asset('storage/'.$event->audio_path) }}" type="audio/mpeg">
            @else
                <source src="{{ asset('audio/backsound.mp3') }}" type="audio/mp3">
            @endif
        </audio>
        
        <div class="audio-icon-wrapper fixed bottom-6 right-6 z-50 w-12 h-12 flex items-center justify-center rounded-full text-white cursor-pointer transition-all duration-300 hover:scale-110 animate-pulse bg-primary shadow-lg border-2 border-white/30 backdrop-blur-sm" style="display: none;">
            <i class="bi bi-disc text-2xl spin-slow"></i>
        </div>
    </div>

        {{-- JS RESOURCES --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simplycountdown.js@1.5.0/dist/simplyCountdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    {{-- CUSTOM SCRIPTS (JANGAN DIUBAH) --}}
    <script>
        // A. Countdown Logic
        simplyCountdown(".simply-countdown", {
            year: new Date("{{ $event->event_date->toIso8601String() }}").getFullYear(),
            month: new Date("{{ $event->event_date->toIso8601String() }}").getMonth() + 1,
            day: new Date("{{ $event->event_date->toIso8601String() }}").getDate(),
            hours: 0, minutes: 0, seconds: 0,
            enableUtc: false,
        });

        // B. Global Variables & Scroll Lock
        const song        = document.getElementById('song');
        const audioButton = document.querySelector('.audio-icon-wrapper');
        const icon        = audioButton.querySelector('i');
        const root        = document.documentElement;
        let isPlaying     = false;

        function disableScroll() {
            const scrollTop  = window.pageYOffset || document.documentElement.scrollTop;
            const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
            window.onscroll  = function() {
                window.scrollTo(scrollLeft, scrollTop);
            };
            root.style.scrollBehavior = 'auto';
        }

        function enableScroll() {
            // Lepas kunci scroll
            window.onscroll = function() {};
            root.style.scrollBehavior = 'smooth';

            // Putar musik
            playAudio();

            // Scroll ke section mempelai
            setTimeout(() => {
                const target = document.getElementById('mempelai');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }, 300);
        }

        function playAudio() {
            if (!song) return;
            song.volume = 0.6;
            song.play().then(() => {
                isPlaying = true;
                audioButton.style.display = "flex";
                icon.classList.add('spin-slow');
                icon.classList.add('bi-disc');
            }).catch(() => {
                // autoplay gagal (mobile) -> abaikan
            });
        }

        // C. Event Listener Tombol Floating
        audioButton.addEventListener('click', function() {
            if (!song) return;
            if (isPlaying) {
                song.pause();
                icon.classList.remove('bi-disc', 'spin-slow');
                icon.classList.add('bi-pause-circle');
            } else {
                song.play();
                icon.classList.add('bi-disc', 'spin-slow');
                icon.classList.remove('bi-pause-circle');
            }
            isPlaying = !isPlaying;
        });

        // D. Init AOS & Scroll Behaviour Awal
        window.onbeforeunload = function () {
            window.scrollTo(0, 0);
        };

        document.addEventListener('DOMContentLoaded', function () {
            disableScroll();   // selalu kunci scroll diawal
            
            AOS.init({ 
                duration: 800, 
                once: true, 
                easing: 'ease-out-cubic', 
                offset: 120 
            });
        });

        // E. Helper CSS Animation
        const styleSheet = document.createElement("style");
        styleSheet.innerText = `
            @keyframes spin { 100% { transform: rotate(360deg); } }
            .spin-slow { animation: spin 4s linear infinite; }
        `;
        document.head.appendChild(styleSheet);
    </script>

    {{-- SCRIPT TAMBAHAN: COPY NOMOR REKENING --}}
    <script>
        function copyToClipboard(id, btn) {
            const target = document.getElementById(id);
            if (!target) return;

            const text = (target.innerText || target.textContent || '').trim();
            if (!text) return;

            const showCopyState = () => {
                if (!btn) return;

                const icon   = btn.querySelector('i');
                const label  = btn.querySelector('span');
                const wrapper = btn.closest('.copy-wrapper');
                const hint   = wrapper ? wrapper.querySelector('.copy-hint') : null;

                // Ganti icon + teks tombol
                if (icon) {
                    icon.classList.remove('bi-copy');
                    icon.classList.add('bi-check2');
                }
                if (label) {
                    label.textContent = 'Tersalin';
                }

                // Tampilkan hint hijau
                if (hint) {
                    hint.style.opacity   = '1';
                    hint.style.transform = 'translateY(0)';
                }

                // Efek kecil di tombol
                btn.classList.add('ring-2', 'ring-emerald-300/70', 'bg-white/20');

                // Kembalikan ke keadaan awal setelah 1.5 detik
                setTimeout(() => {
                    if (icon) {
                        icon.classList.remove('bi-check2');
                        icon.classList.add('bi-copy');
                    }
                    if (label) {
                        label.textContent = 'Salin';
                    }
                    if (hint) {
                        hint.style.opacity   = '0';
                        hint.style.transform = 'translateY(-0.25rem)';
                    }
                    btn.classList.remove('ring-2', 'ring-emerald-300/70', 'bg-white/20');
                }, 1500);
            };

            // Pakai Clipboard API modern
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text)
                    .then(showCopyState)
                    .catch(() => fallbackCopy(text, showCopyState));
            } else {
                fallbackCopy(text, showCopyState);
            }
        }

        function fallbackCopy(text, callback) {
            const temp = document.createElement('textarea');
            temp.value = text;
            temp.setAttribute('readonly', '');
            temp.style.position = 'absolute';
            temp.style.left = '-9999px';
            document.body.appendChild(temp);
            temp.select();

            try {
                document.execCommand('copy');
            } catch (e) {
                console.warn('Gagal menyalin secara manual:', e);
            }

            document.body.removeChild(temp);
            if (typeof callback === 'function') callback();
        }
    </script>

</body>
</html>

