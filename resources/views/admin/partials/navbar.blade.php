<div class="flex items-center justify-between w-full">
    
    {{-- KIRI: Menu Pintasan --}}
    <ul class="flex items-center gap-4">
        {{-- Tombol Lihat Website --}}
        <li>
            <a href="{{ route('home') }}" 
               target="_blank" 
               class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-primary-600 transition-colors px-3 py-2 rounded-lg hover:bg-primary-50"
               title="Buka Halaman Depan">
                <i class="bi bi-box-arrow-up-right text-lg"></i>
                <span class="hidden sm:inline">Lihat Website</span>
            </a>
        </li>
    </ul>

    {{-- KANAN: Utilitas & User --}}
    <ul class="flex items-center gap-3">
        
        {{-- Tombol Fullscreen (Alpine.js Logic) --}}
        <li x-data="{ 
                isFullscreen: false,
                toggle() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen();
                        this.isFullscreen = true;
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen(); 
                            this.isFullscreen = false;
                        }
                    }
                }
            }">
            <button 
                @click="toggle()"
                class="p-2 text-slate-400 hover:text-primary-600 hover:bg-slate-100 rounded-full transition-all focus:outline-none"
                title="Mode Layar Penuh"
            >
                {{-- Ikon berubah sesuai status --}}
                <i class="bi" :class="isFullscreen ? 'bi-fullscreen-exit' : 'bi-arrows-fullscreen'"></i>
            </button>
        </li>

        {{-- Divider Kecil --}}
        <li class="h-6 w-px bg-slate-200 mx-1"></li>

        {{-- User Profile (Nama Admin) --}}
        <li class="flex items-center gap-3 pl-2">
            <div class="text-right hidden md:block">
                <div class="text-sm font-bold text-slate-700 leading-tight">
                    {{ Auth::user()->name ?? 'Admin' }}
                </div>
                <div class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">
                    Administrator
                </div>
            </div>
            <div class="w-9 h-9 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-sm border-2 border-white shadow-sm">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
        </li>

    </ul>
</div>