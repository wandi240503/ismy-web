<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ISMY Yogyakarta') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}"/>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-warm-cream text-gray-900 min-h-screen flex flex-col justify-between">
        
        <div class="flex-grow flex flex-col sm:justify-center items-center px-4 py-8">
            <!-- Brand Logo & Title -->
            <div class="text-center mb-6">
                <a href="{{ route('beranda') }}" class="inline-flex flex-col items-center gap-2 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo ISMY" class="h-16 w-16 object-contain drop-shadow-sm transition-transform group-hover:scale-105" style="max-height: 64px; max-width: 64px;" />
                    <div class="flex flex-col items-center">
                        <span class="text-2xl font-serif font-black text-[#0F4C3A] tracking-wide">ISMY</span>
                        <span class="text-[10px] font-sans font-bold text-[#C9A227] uppercase tracking-widest">Ikatan Sarjana Melayu Yogyakarta</span>
                    </div>
                </a>
            </div>

            <!-- Card Container -->
            <div class="w-full sm:max-w-md bg-white p-8 rounded-2xl shadow-xl border border-emerald-900/10">
                {{ $slot }}
            </div>

            <!-- Back to Home Link -->
            <div class="mt-6 text-center">
                <a href="{{ route('beranda') }}" class="text-xs font-bold text-[#0F4C3A] hover:text-[#C9A227] inline-flex items-center gap-1 transition-colors">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Beranda Utama
                </a>
            </div>
        </div>

        <!-- Mini Footer -->
        <div class="py-4 text-center border-t border-emerald-900/10 bg-white/60">
            <p class="text-xs text-gray-500">© {{ date('Y') }} Ikatan Sarjana Melayu Yogyakarta. Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </body>
</html>
