{{-- Style agar elemen tidak kedip sebelum Alpine aktif --}}
<style>[x-cloak] { display: none !important; }</style>

<div 
    x-data="navbarLogic()" 
    x-init="init()" 
    x-cloak
    class="relative"
>
    {{-- NAVBAR UTAMA (Fixed & Sticky) --}}
    <nav 
        :class="scrolled 
            ? 'translate-y-0 bg-white/95 shadow-xl backdrop-blur-md border-b border-slate-100' 
            : '-translate-y-full'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-in-out py-3"
    >
        <div class="container mx-auto max-w-7xl flex items-center justify-between px-4 md:px-8">

            {{-- Logo / Brand --}}
            <a href="#hero" class="flex items-center gap-2 group focus:outline-none focus:ring-2 focus:ring-primary-600 rounded-lg">
                <div class="w-9 h-9 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center shadow-inner">
                    <i class="bi bi-balloon-heart-fill text-lg"></i>
                </div>
                <span class="font-esthetic text-2xl font-bold text-slate-800 group-hover:text-primary-600 transition tracking-wide">
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
                        :class="(active == item.link.replace('#', '')) 
                            ? 'bg-primary-600 text-white shadow shadow-primary-500/50' 
                            : 'text-slate-600 hover:bg-primary-50 hover:text-primary-600'"
                    >
                        <span x-text="item.text"></span>
                    </a>
                </template>
            </div>

            {{-- Mobile Hamburger --}}
            <button 
                @click="open = true"
                class="lg:hidden p-2 text-slate-700 hover:bg-slate-100 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-primary-600"
            >
                <i class="bi bi-list text-3xl"></i>
            </button>
        </div>
    </nav>

    {{-- OVERLAY (untuk menutup drawer saat di-klik) --}}
    <div 
        x-show="open" 
        x-transition.opacity.duration.300ms
        @click="open = false"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[90] lg:hidden"
    ></div>

    {{-- DRAWER MENU (Mobile Menu) --}}
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 h-full w-72 max-w-[80vw] bg-white shadow-2xl z-[100] lg:hidden flex flex-col border-l border-slate-100"
    >
        {{-- Drawer Header --}}
        <div class="flex items-center justify-between p-5 bg-slate-50 border-b">
            <span class="font-esthetic text-2xl text-primary-600 font-bold">Navigasi</span>
            <button @click="open = false" class="w-8 h-8 flex items-center justify-center rounded-full border border-slate-200 hover:bg-red-50 hover:text-red-500 transition focus:outline-none focus:ring-2 focus:ring-red-300">
                <i class="bi bi-x-lg text-sm"></i>
            </button>
        </div>

        {{-- Menu List --}}
        <div class="flex-1 overflow-y-auto py-4 px-5 space-y-2 bg-white">
            <template x-for="item in menu" :key="item.link">
                <a 
                    :href="item.link" 
                    @click="open = false; active = item.link.replace('#', '')"
                    class="flex items-center justify-between px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-primary-50 hover:text-primary-600 transition border border-transparent hover:border-primary-100"
                >
                    <span x-text="item.text"></span>
                    <i class="bi bi-chevron-right text-xs opacity-50"></i>
                </a>
            </template>

            {{-- CTA Button --}}
            <div class="mt-6 pt-6 border-t border-slate-100">
                <a href="#rsvp" @click="open = false" class="block w-full py-3 text-center bg-primary-600 text-white rounded-xl font-bold shadow-lg hover:bg-primary-700 transition">
                    <i class="bi bi-chat-heart me-2"></i>
                    Kirim Ucapan
                </a>
            </div>
        </div>

        {{-- Drawer Footer --}}
        <div class="p-4 text-center bg-slate-50 text-xs text-slate-400 border-t">
            <p>&copy; {{ date('Y') }} {{ $event->child_name }}</p>
            <p class="text-[10px] mt-1">Dibuat dengan ❤️</p>
        </div>
    </div>
</div>

{{-- LOGIKA SCROLLSPY DAN LOGIKA BARU --}}
<script>
    function navbarLogic() {
        return {
            scrolled: false,
            open: false,
            active: 'hero', // Ganti 'home' menjadi 'hero' agar konsisten dengan ID section
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
                // 1. Logika muncul saat scroll > 100
                this.scrolled = window.scrollY > 100;

                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 100;
                    this.updateActiveSection();
                });
                
                // 2. LOGIKA BARU: Muncul saat tombol 'Buka Undangan' diklik
                window.addEventListener('invitation-opened', () => {
                    this.scrolled = true; // Langsung munculkan navbar
                });

                // Inisiasi Active Section awal
                this.updateActiveSection();
            },
            updateActiveSection() {
                // Tentukan offset untuk penandaan aktif
                const offset = 180; 

                this.menu.forEach(item => {
                    const section = document.querySelector(item.link);
                    if (section) {
                        const pos = section.getBoundingClientRect().top;
                        
                        // Cek apakah bagian tersebut berada di dalam viewport (tepat di bawah navbar)
                        if (pos <= offset && pos > - (section.offsetHeight - offset)) {
                            this.active = item.link.replace('#', '');
                        }
                    }
                });
            }
        }
    }
</script>