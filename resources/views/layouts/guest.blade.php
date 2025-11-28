<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel | @yield('title')</title>

    {{-- Fonts: Plus Jakarta Sans (Modern Standard) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icons: Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Engine: Tailwind CSS & Alpine.js --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#0EA5E9', 
                            600: '#0284C7',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Desain Background Login (Gelap/Biru) */
        .login-bg {
            background-color: #0c4a6e; /* Primary 900 */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 80 120'%3E%3Cg fill='%231e3a8a' fill-opacity='0.1'%3E%3Cpath fill-rule='evenodd' d='M0 0h40v60H0V0zm40 60h40v60H40V60z'/%P%3C/g%3E%3C/svg%3E");
            background-size: 80px 120px;
        }
    </style>
</head>
<body class="login-bg text-slate-700 font-sans antialiased flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md">
        {{-- Logo (Mengganti x-application-logo) --}}
        <div class="mb-6 text-center">
            <a href="{{ route('home') }}" class="inline-block">
                <div class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-lg">
                    <i class="bi bi-shield-lock-fill text-2xl"></i>
                </div>
            </a>
        </div>

        {{-- Konten Login/Register akan di-inject di sini --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @yield('content')
        </div>
    </div>

</body>
</html>