<style>
    /* ---------------------- Custom CSS untuk Tema 10 ---------------------- */
    
    /* Global Background untuk Magenta & Mint */
    body {
        background-color: #f5f5f4; /* stone-100 */
        color: #1e293b; /* slate-800 */
    }

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
    
    /* Style agar elemen tidak kedip sebelum Alpine aktif */
    [x-cloak] { display: none !important; }

    /* CSS Scrollbar (Untuk List Ucapan) */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #be185d; /* rose-700 */ border-radius: 20px; }
</style>

{{-- LOGIKA SCROLLSPY (Alpine JS) --}}
<script>
    function navbarLogic() {
        return {
            scrolled: false,
            open: false,
            active: 'hero',
            menu: [
                { text: 'Beranda', link: '#hero' },
                { text: 'Profil', link: '#mempelai' },
                { text: 'Acara', link: '#acara' },
                { text: 'Hiburan', link: '#entertainment' },
                { text: 'Galeri', link: '#galeri' },
                { text: 'Ucapan', link: '#rsvp' },
                { text: 'Hadiah', link: '#gifts' }
            ],
            init() {
                this.scrolled = window.scrollY > 100;

                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 100;
                    this.updateActiveSection();
                });
            },
            updateActiveSection() {
                this.menu.forEach(item => {
                    const section = document.querySelector(item.link);
                    if (section) {
                        const pos = section.getBoundingClientRect().top;
                        if (pos <= 150 && pos > - (section.offsetHeight - 200)) {
                            this.active = item.link.replace('#', '');
                        }
                    }
                });
            }
        }
    }

    // Fungsi JS untuk Copy to Clipboard (Hadiah)
    function copyToClipboard(elementId, button) {
        const element = document.getElementById(elementId);
        const textarea = document.createElement('textarea');
        textarea.value = element.innerText.trim();
        document.body.appendChild(textarea);
        
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        const originalIcon = button.querySelector('i').className;
        button.querySelector('i').className = 'bi bi-check-lg';
        
        setTimeout(() => {
            button.querySelector('i').className = originalIcon;
        }, 2000);
    }
</script>

{{-- SWEETALERT 2 (Notifikasi Sukses RSVP) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Terima Kasih!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#d946ef', // Fuchsia 600 (Aksen Tema 10)
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'rounded-3xl',
            confirmButton: 'px-6 py-2 rounded-xl font-bold'
        }
    });
</script>
@endif
<div 
    x-data="navbarLogic()" 
    x-init="init()" 
    x-cloak
    class="relative"
>
    {{-- NAVBAR UTAMA --}}
    <nav 
        :class="scrolled 
            ? 'translate-y-0 bg-white/95 shadow-lg backdrop-blur-md border-b border-fuchsia-200' 
            : '-translate-y-full'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-in-out py-3"
    >
        <div class="container mx-auto flex items-center justify-between px-4 md:px-8">

            {{-- Logo / Brand (Aksen Magenta Tua) --}}
            <a href="#hero" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-full bg-fuchsia-100 text-fuchsia-700 flex items-center justify-center">
                    <i class="bi bi-balloon-heart-fill text-lg"></i>
                </div>
                <span class="font-sans text-2xl font-bold text-slate-800 group-hover:text-fuchsia-700 transition">
                    {{ Str::limit($event->child_name ?? 'Khitanan', 15) }}
                </span>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center space-x-1">
                <template x-for="item in menu" :key="item.link">
                    <a 
                        :href="item.link" 
                        @click="active = item.link.replace('#', '')"
                        class="px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300"
                        {{-- Menu Aktif: bg-fuchsia-700 --}}
                        :class="(active == item.link.replace('#', '')) 
                            ? 'bg-fuchsia-700 text-white shadow-md shadow-fuchsia-300' 
                            {{-- Menu Hover: hover:bg-fuchsia-100, hover:text-fuchsia-700 --}}
                            : 'text-slate-600 hover:bg-fuchsia-100 hover:text-fuchsia-700'"
                    >
                        <span x-text="item.text"></span>
                    </a>
                </template>
            </div>

            {{-- Mobile Hamburger --}}
            <button 
                @click="open = true"
                class="lg:hidden p-2 text-slate-700 hover:bg-fuchsia-100 hover:text-fuchsia-700 rounded-lg transition"
            >
                <i class="bi bi-list text-3xl"></i>
            </button>
        </div>
    </nav>

    {{-- OVERLAY --}}
    <div 
        x-show="open" 
        x-transition.opacity.duration.300ms
        @click="open = false"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[90] lg:hidden"
    ></div>

    {{-- DRAWER MENU (Sidebar Mobile) --}}
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 h-full w-72 bg-white shadow-2xl z-[100] lg:hidden flex flex-col border-l border-fuchsia-100"
    >
        {{-- Drawer Header (Aksen Magenta Tua) --}}
        <div class="flex items-center justify-between p-5 bg-fuchsia-50 border-b border-fuchsia-100">
            <span class="font-sans text-2xl text-fuchsia-700 font-bold">Menu</span>
            <button @click="open = false" class="w-8 h-8 flex items-center justify-center rounded-full border border-fuchsia-200 hover:bg-fuchsia-100 hover:text-red-600 transition text-slate-700">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- Menu List --}}
        <div class="flex-1 overflow-y-auto py-4 px-5 space-y-2 bg-white">
            <template x-for="item in menu" :key="item.link">
                <a 
                    :href="item.link" 
                    @click="open = false; active = item.link.replace('#', '')"
                    class="flex items-center justify-between px-4 py-3 rounded-xl text-slate-600 font-medium hover:bg-fuchsia-100 hover:text-fuchsia-700 transition border border-transparent hover:border-fuchsia-200"
                >
                    <span x-text="item.text"></span>
                    <i class="bi bi-chevron-right text-xs opacity-50"></i>
                </a>
            </template>

            {{-- CTA Button (Aksen Magenta Tua) --}}
            <div class="mt-6 pt-6 border-t border-fuchsia-100">
                <a href="#rsvp" @click="open = false" class="block w-full py-3 text-center bg-fuchsia-700 text-white rounded-xl font-bold shadow-lg shadow-fuchsia-300/40 hover:bg-fuchsia-600 transition">
                    Kirim Ucapan
                </a>
            </div>
        </div>

        {{-- Drawer Footer (Hangat) --}}
        <div class="p-4 text-center bg-fuchsia-50 text-xs text-slate-600 border-t border-fuchsia-100">
            © {{ date('Y') }} {{ $event->child_name }}
        </div>
    </div>
</div>