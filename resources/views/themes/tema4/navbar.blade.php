<style>
    /* ---------------------- Custom CSS untuk Tema 4 ---------------------- */
    
    /* Global Background untuk Dark Mode */
    body {
        background-color: #0f172a; /* slate-900 */
        color: #f1f5f9; /* slate-100 */
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
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #334155; /* slate-700 */ border-radius: 20px; }
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
        confirmButtonColor: '#06B6D4', // Cyan 600 (Aksen Tema 4)
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
            ? 'translate-y-0 bg-slate-900/95 shadow-xl backdrop-blur-md border-b border-cyan-800' 
            : '-translate-y-full'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-in-out py-3"
    >
        <div class="container mx-auto flex items-center justify-between px-4 md:px-8">

            {{-- Logo / Brand (Aksen Cyan) --}}
            <a href="#hero" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-full bg-cyan-800/20 text-cyan-400 flex items-center justify-center">
                    <i class="bi bi-balloon-heart-fill text-lg"></i>
                </div>
                <span class="font-sans text-2xl font-bold text-slate-100 group-hover:text-cyan-400 transition">
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
                        {{-- Menu Aktif: bg-cyan-600 --}}
                        :class="(active == item.link.replace('#', '')) 
                            ? 'bg-cyan-600 text-white shadow-md shadow-cyan-900' 
                            {{-- Menu Hover: hover:bg-slate-700, hover:text-cyan-400 --}}
                            : 'text-slate-300 hover:bg-slate-800 hover:text-cyan-400'"
                    >
                        <span x-text="item.text"></span>
                    </a>
                </template>
            </div>

            {{-- Mobile Hamburger --}}
            <button 
                @click="open = true"
                class="lg:hidden p-2 text-slate-300 hover:bg-slate-800 hover:text-cyan-400 rounded-lg transition"
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
        class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[90] lg:hidden"
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
        class="fixed right-0 top-0 h-full w-72 bg-slate-900 shadow-2xl z-[100] lg:hidden flex flex-col border-l border-slate-700"
    >
        {{-- Drawer Header (Aksen Cyan) --}}
        <div class="flex items-center justify-between p-5 bg-slate-800 border-b border-slate-700">
            <span class="font-sans text-2xl text-cyan-400 font-bold">Menu</span>
            <button @click="open = false" class="w-8 h-8 flex items-center justify-center rounded-full border border-slate-600 hover:bg-slate-700 hover:text-red-500 transition text-slate-300">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- Menu List --}}
        <div class="flex-1 overflow-y-auto py-4 px-5 space-y-2 bg-slate-900">
            <template x-for="item in menu" :key="item.link">
                <a 
                    :href="item.link" 
                    @click="open = false; active = item.link.replace('#', '')"
                    class="flex items-center justify-between px-4 py-3 rounded-xl text-slate-300 font-medium hover:bg-slate-800 hover:text-cyan-400 transition border border-transparent hover:border-slate-700"
                >
                    <span x-text="item.text"></span>
                    <i class="bi bi-chevron-right text-xs opacity-50"></i>
                </a>
            </template>

            {{-- CTA Button (Aksen Cyan Tua) --}}
            <div class="mt-6 pt-6 border-t border-slate-700">
                <a href="#rsvp" @click="open = false" class="block w-full py-3 text-center bg-cyan-600 text-white rounded-xl font-bold shadow-lg shadow-cyan-900/40 hover:bg-cyan-500 transition">
                    Kirim Ucapan
                </a>
            </div>
        </div>

        {{-- Drawer Footer (Minimalis) --}}
        <div class="p-4 text-center bg-slate-800 text-xs text-slate-500 border-t border-slate-700">
            &copy; {{ date('Y') }} {{ $event->child_name }}
        </div>
    </div>
</div>