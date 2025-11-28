<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | @yield('title')</title>

    {{-- Favicon (Ambil dari logo_path jika ada, atau fallback ke favicon.ico) --}}
    @if (!empty($settings->logo_path))
        <link rel="shortcut icon" href="{{ asset('storage/' . $settings->logo_path) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    {{-- Fonts: Plus Jakarta Sans (Modern Standard) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icons: Bootstrap Icons (Konsisten dengan Frontend) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Engine: Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#0EA5E9', // Sky 500
                            50: '#F0F9FF',
                            600: '#0284C7', // Sky 600
                            800: '#075985',
                            900: '#0C4A6E',
                        }
                    }
                }
            }
        }
    </script>

    {{-- Engine: Alpine.js (Untuk Interaksi Sidebar/Dropdown) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style type="text/tailwindcss">
        @layer utilities {
            .text-shadow { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); }
        }
        /* Custom Scrollbar untuk Admin */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        {{-- 1. SIDEBAR WRAPPER --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transition-transform duration-300 ease-in-out transform md:translate-x-0 md:static md:inset-0 flex flex-col"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            @include('admin.partials.sidebar')
            
        </aside>

        {{-- Overlay Gelap untuk Mobile saat Sidebar terbuka --}}
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-transition.opacity 
             class="fixed inset-0 bg-slate-900/50 z-40 md:hidden">
        </div>

        {{-- 2. MAIN CONTENT WRAPPER --}}
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            
            {{-- NAVBAR (Header) --}}
            <header class="relative z-10 flex items-center justify-between h-16 px-6 bg-white border-b border-slate-200 shadow-sm">
                {{-- Mobile Menu Button --}}
                <button @click="sidebarOpen = true" class="p-1 mr-4 text-slate-500 rounded-md md:hidden focus:outline-none hover:text-primary-600">
                    <i class="bi bi-list text-2xl"></i>
                </button>

                @include('admin.partials.navbar')
            </header>

            {{-- CONTENT SCROLLABLE AREA --}}
            <main class="flex-1 overflow-y-auto bg-slate-50 p-6 relative">
                
                {{-- Judul Halaman --}}
                <div class="mb-6 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-slate-800">@yield('title')</h1>
                </div>

                {{-- Isi Konten Utama --}}
                <div class="min-h-[70vh]">
                    @yield('content')
                </div>

                {{-- FOOTER --}}
                <footer class="mt-20 py-6 border-t border-slate-200 text-center text-sm text-slate-400">
                    @include('admin.partials.footer')
                </footer>

            </main>
        </div>

    </div>

</body>
</html>