@extends('layouts.guest')

@section('title', 'Login Admin')

@section('content')

<div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
    
    {{-- HEADER CARD: Logo/Judul Dengan Shadow --}}
    <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/70">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-600 text-white shadow-xl shadow-primary-300/50 mb-3">
                <i class="bi bi-shield-lock-fill text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-slate-800">Admin Panel Access</h1>
            <p class="text-sm text-slate-500 mt-1">Gunakan akun Anda untuk mengelola data undangan.</p>
        </div>
    </div>
    
    <div class="p-6 md:p-8">
        
        {{-- Session Status --}}
        @if (session('status'))
            <div class="bg-primary-50 border border-primary-200 text-primary-700 p-3 rounded-xl mb-4 text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif
        
        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl mb-4 text-sm font-medium">
                Kredensial yang Anda masukkan tidak cocok.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- 1. Email Address (Dengan Icon) --}}
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="bi bi-envelope text-slate-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                           autocomplete="username"
                           class="w-full pl-11 pr-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-primary-200 focus:border-primary-500' }} transition-all" 
                           placeholder="Masukkan alamat email">
                    
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- 2. Password (Dengan Icon) --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="bi bi-key text-slate-400"></i>
                    </div>
                    <input id="password" type="password" name="password" required 
                           autocomplete="current-password" 
                           class="w-full pl-11 pr-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-red-500 focus:ring-red-200' : 'border-slate-300 focus:ring-primary-200 focus:border-primary-500' }} transition-all" 
                           placeholder="Masukkan password">
                    
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- 3. Remember Me & Forgot Password --}}
            <div class="flex items-center justify-between mt-4">
                {{-- Remember Me --}}
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span class="ms-2 text-sm text-slate-600">{{ __('Ingat Saya') }}</span>
                </label>

                {{-- Forgot Password Link --}}
                @if (Route::has('password.request'))
                    <a class="text-sm text-primary-600 hover:text-primary-800 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            {{-- 4. Submit Button --}}
            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="w-full py-3 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all transform hover:-translate-y-0.5">
                    {{ __('Log in') }}
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
</div>
@endsection