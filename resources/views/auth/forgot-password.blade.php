@extends('layouts.guest')

@section('title', 'Lupa Password')

@section('content')

<div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-slate-100 p-6 md:p-8">
    
    {{-- Header / Link Kembali --}}
    <div class="text-center mb-6">
        <a href="{{ route('login') }}" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-600 shadow-md mb-3 hover:bg-primary-200 transition-colors">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Lupa Password</h1>
        <p class="text-sm text-slate-500 mt-1">
            Masukkan email Anda untuk menerima tautan reset password.
        </p>
    </div>

    {{-- Session Status (Pesan Sukses) --}}
    @if (session('status'))
        <div class="bg-primary-50 border border-primary-200 text-primary-700 p-3 rounded-lg mb-4 text-sm font-medium">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- Email Input --}}
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-primary-200 focus:border-primary-500' }} transition-all" 
                   placeholder="Masukkan email terdaftar">
            
            @error('email')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="w-full py-3 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all transform hover:-translate-y-0.5">
                {{ __('Kirim Tautan Reset Password') }}
            </button>
        </div>
    </form>

    {{-- Link ke Halaman Utama --}}
    <div class="text-center mt-6 pt-4 border-t border-slate-100">
        <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-slate-700 hover:underline">
            ← Kembali ke Undangan
        </a>
    </div>

</div>
@endsection