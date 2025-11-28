<div class="flex flex-col md:flex-row items-center justify-between gap-4">
    
    {{-- Bagian Kiri: Copyright --}}
    <div class="text-center md:text-left text-sm">
        <span class="font-bold text-slate-700">Copyright &copy; {{ date('Y') }}</span> 
        <a href="{{ route('admin.dashboard') }}" class="text-primary-600 hover:text-primary-700 hover:underline font-bold transition-colors">
            Ozan Project
        </a>. 
        <span class="text-slate-500">All rights reserved.</span>
    </div>

    {{-- Bagian Kanan: Versi --}}
    <div class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
        <b>Versi</b> 1.0
    </div>

</div>