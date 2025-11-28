{{-- Style agar elemen tidak kedip sebelum Alpine aktif --}}
<style>[x-cloak] { display: none !important; }</style>

<div 
    x-data="navbarLogic()" 
    x-init="init()" 
    x-cloak
    class="relative"
>
    {{-- NAVBAR UTAMA --}}
    <nav 
        :class="scrolled 
            ? 'translate-y-0 bg-white/95 shadow-xl backdrop-blur-md border-b border-green-100' 
            : '-translate-y-full'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-in-out py-3"
    >
        <div class="container mx-auto flex items-center justify-between px-4 md:px-8">

            {{-- Logo / Brand (Aksen Hijau Tua) --}}
            <a href="#hero" class="flex items-center gap-2 group">
                {{-- Aksen Logo: Ganti primary-100/600 menjadi green-100/800 --}}
                <div class="w-9 h-9 rounded-full bg-green-100 text-green-800 flex items-center justify-center">
                    <i class="bi bi-balloon-heart-fill text-lg"></i>
                </div>
                {{-- Text Brand: Lebih tegas di desktop --}}
                <span class="font-serif-elegan text-2xl font-bold text-slate-800 group-hover:text-green-800 transition">
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
                        {{-- Menu Aktif: bg-green-800, Shadow yang lebih lembut --}}
                        :class="(active == item.link.replace('#', '')) 
                            ? 'bg-green-800 text-white shadow-md shadow-green-200' 
                            {{-- Menu Hover: hover:bg-green-50, hover:text-green-800 --}}
                            : 'text-slate-600 hover:bg-green-50 hover:text-green-800'"
                    >
                        <span x-text="item.text"></span>
                    </a>
                </template>
            </div>

            {{-- Mobile Hamburger --}}
            <button 
                @click="open = true"
                class="lg:hidden p-2 text-slate-700 hover:bg-green-50 hover:text-green-800 rounded-lg transition"
            >
                <i class="bi bi-list text-3xl"></i>
            </button>
        </div>
    </nav>

    {{-- OVERLAY (Tidak ada perubahan) --}}
    <div 
        x-show="open" 
        x-transition.opacity.duration.300ms
        @click="open = false"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[90] lg:hidden"
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
        class="fixed right-0 top-0 h-full w-72 bg-white shadow-2xl z-[100] lg:hidden flex flex-col border-l border-green-50"
    >
        {{-- Drawer Header (Aksen Hijau Tua) --}}
        <div class="flex items-center justify-between p-5 bg-green-50/50 border-b border-green-100">
            <span class="font-serif-elegan text-2xl text-green-800 font-bold">Menu</span>
            <button @click="open = false" class="w-8 h-8 flex items-center justify-center rounded-full border border-green-200 hover:bg-green-100 hover:text-red-600 transition">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- Menu List --}}
        <div class="flex-1 overflow-y-auto py-4 px-5 space-y-2 bg-white">
            <template x-for="item in menu" :key="item.link">
                <a 
                    :href="item.link" 
                    @click="open = false; active = item.link.replace('#', '')"
                    {{-- Aksen Hover: hover:bg-green-50, hover:text-green-800 --}}
                    class="flex items-center justify-between px-4 py-3 rounded-xl text-slate-600 font-medium hover:bg-green-50 hover:text-green-800 transition border border-transparent hover:border-green-100"
                >
                    <span x-text="item.text"></span>
                    <i class="bi bi-chevron-right text-xs opacity-50"></i>
                </a>
            </template>

            {{-- CTA Button (Aksen Hijau Tua) --}}
            <div class="mt-6 pt-6 border-t border-green-100">
                <a href="#rsvp" @click="open = false" class="block w-full py-3 text-center bg-green-800 text-white rounded-xl font-bold shadow-lg shadow-green-900/40 hover:bg-green-700 transition">
                    Kirim Ucapan
                </a>
            </div>
        </div>

        {{-- Drawer Footer (Minimalis) --}}
        <div class="p-4 text-center bg-green-50/50 text-xs text-slate-600 border-t border-green-100">
            &copy; {{ date('Y') }} {{ $event->child_name }}
        </div>
    </div>
</div>

{{-- LOGIKA SCROLLSPY (TIDAK ADA PERUBAHAN) --}}
<script>
    function navbarLogic() {
        return {
            scrolled: false,
            open: false,
            active: 'hero', // Ganti 'home' menjadi 'hero' agar sesuai dengan link pertama
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
</script>
