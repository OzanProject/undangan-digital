@extends('layouts.admin')

@section('title', 'Dashboard Statistik')

@section('content')

    {{-- 1. WELCOME BANNER --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-8 mb-8 shadow-lg text-white">
        {{-- Pattern Background --}}
        <div class="absolute top-0 right-0 opacity-10 transform translate-x-10 -translate-y-10">
            <i class="bi bi-balloon-heart-fill text-[150px]"></i>
        </div>
        
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">
                Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 👋
            </h2>
            <p class="text-primary-100 max-w-xl text-sm md:text-base">
                Ini adalah halaman statistik undangan digital Anda. Pantau jumlah tamu, ucapan, dan acara yang masuk secara real-time di sini.
            </p>
        </div>
    </div>

    {{-- 2. STATISTIC CARDS (Grid 3 Kolom) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- CARD 1: TOTAL TAMU --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Total Tamu</p>
                    <h3 class="text-4xl font-bold text-slate-800 mb-1">
                        {{ $totalGuests }}
                        <span class="text-sm font-normal text-slate-400">Orang</span>
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            
            {{-- Footer Link --}}
            <div class="mt-6 pt-4 border-t border-slate-50">
                <a href="{{ route('admin.guests.index') }}" class="flex items-center text-sm font-medium text-primary-600 hover:text-primary-700 gap-2">
                    <span>Kelola Data Tamu</span>
                    <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>

        {{-- CARD 2: TOTAL UCAPAN --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Ucapan Masuk</p>
                    <h3 class="text-4xl font-bold text-slate-800 mb-1">
                        {{ $totalWishes }}
                        <span class="text-sm font-normal text-slate-400">Pesan</span>
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    <i class="bi bi-chat-heart-fill"></i>
                </div>
            </div>
            
            {{-- Footer Link --}}
            <div class="mt-6 pt-4 border-t border-slate-50">
                <a href="{{ route('admin.wishes.index') }}" class="flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-700 gap-2">
                    <span>Lihat Semua Ucapan</span>
                    <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
        
        {{-- CARD 3: TOTAL HIBURAN (BARU) --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Total Acara Hiburan</p>
                    <h3 class="text-4xl font-bold text-slate-800 mb-1">
                        {{ $totalEntertainments ?? 0 }}
                        <span class="text-sm font-normal text-slate-400">Item</span>
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    <i class="bi bi-music-note-list"></i>
                </div>
            </div>
            
            {{-- Footer Link --}}
            <div class="mt-6 pt-4 border-t border-slate-50">
                <a href="{{ route('admin.entertainments.index') }}" class="flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 gap-2">
                    <span>Kelola Acara</span>
                    <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- 3. QUICK ACTIONS --}}
    <div class="mt-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Aksi Cepat</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.settings') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-600 hover:text-primary-600 hover:border-primary-200 hover:shadow-sm transition-all">
                <i class="bi bi-pencil-square"></i> Edit Info Acara
            </a>
            <a href="{{ route('admin.guests.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-600 hover:text-primary-600 hover:border-primary-200 hover:shadow-sm transition-all">
                <i class="bi bi-person-plus-fill"></i> Tambah Tamu Baru
            </a>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-800 text-white border border-transparent rounded-xl hover:bg-slate-700 shadow-sm transition-all">
                <i class="bi bi-globe"></i> Lihat Website Live
            </a>
        </div>
    </div>

@endsection