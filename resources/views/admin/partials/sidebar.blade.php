{{-- 1. LOGO BRANDING --}}
<div class="flex items-center justify-center h-16 bg-slate-950 shadow-sm border-b border-slate-800 shrink-0">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 group p-2">
        
        {{-- LOGIKA DISPLAY LOGO (JIKA ADA) ATAU FALLBACK KE IKON/TEKS --}}
        @if(!empty($settings->logo_path))
            {{-- Tampilkan Logo dari Storage --}}
            <div class="w-10 h-10 rounded-lg bg-white p-1 shadow-xl flex items-center justify-center transition-transform group-hover:scale-105">
                <img src="{{ asset('storage/' . $settings->logo_path) }}" 
                     alt="Logo Admin" 
                     class="w-full h-full object-contain">
            </div>
        @else
            {{-- Fallback: Tampilkan Ikon Kunci --}}
            <div class="w-8 h-8 rounded-lg bg-primary-600 text-white flex items-center justify-center shadow-lg shadow-primary-900/50 transition-transform group-hover:scale-110">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
        @endif

        <span class="text-lg font-bold tracking-wide text-white group-hover:text-primary-400 transition-colors">
            Admin Panel
        </span>
    </a>
</div>
{{-- 2. MENU NAVIGASI (Dibiarkan sama) --}}
<nav class="flex-1 px-3 py-4 overflow-y-auto space-y-1">
    
    {{-- DASHBOARD --}}
    <a href="{{ route('admin.dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="bi bi-speedometer2 text-lg {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
        <span>Dashboard</span>
    </a>

    {{-- KELOLA DATA --}}
    <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
        Kelola Data
    </div>

    {{-- DATA TAMU --}}
    <a href="{{ route('admin.guests.index') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.guests.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="bi bi-people text-lg {{ request()->routeIs('admin.guests.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
        <span>Data Tamu</span>
    </a>

    {{-- BUKU TAMU / UCAPAN --}}
    <a href="{{ route('admin.wishes.index') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.wishes.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="bi bi-chat-quote text-lg {{ request()->routeIs('admin.wishes.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
        <span>Buku Tamu</span>
    </a>

    {{-- KONTEN WEBSITE --}}
    <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
        Konten Website
    </div>

    {{-- PENGATURAN UMUM --}}
    <a href="{{ route('admin.settings') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.settings') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="bi bi-sliders text-lg {{ request()->routeIs('admin.settings') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
        <span>Pengaturan Umum</span>
    </a>

    {{-- GALERI FOTO --}}
    <a href="{{ route('admin.galleries.index') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.galleries.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="bi bi-images text-lg {{ request()->routeIs('admin.galleries.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
        <span>Galeri Foto</span>
    </a>
    
    {{-- ACARA HIBURAN --}}
    <a href="{{ route('admin.entertainments.index') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.entertainments.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="bi bi-music-note-list text-lg {{ request()->routeIs('admin.entertainments.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
        <span>Acara Hiburan</span>
    </a>

    {{-- MANAJEMEN USER (BARU) --}}
    <a href="{{ route('admin.users.index') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="bi bi-person-circle text-lg {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"></i>
        <span>Manajemen User</span>
    </a>

</nav>

{{-- 3. LOGOUT BUTTON (Sticky Bottom) --}}
<div class="p-4 border-t border-slate-800 bg-slate-900">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" 
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-400 rounded-xl hover:bg-red-500/10 hover:text-red-300 transition-all duration-200 group">
            <i class="bi bi-box-arrow-right text-lg group-hover:translate-x-1 transition-transform"></i>
            <span>Logout</span>
        </a>
    </form>
</div>