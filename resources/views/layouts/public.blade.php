<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('puskesmas.name'))</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
        <a href="{{ route('home') }}" class="text-lg font-bold text-emerald-700">{{ config('puskesmas.name') }}</a>
        <nav class="hidden gap-6 text-sm font-medium text-slate-600 md:flex">
            <a href="{{ route('home') }}#sambutan" class="hover:text-emerald-700">Sambutan</a>
            <a href="{{ route('home') }}#jam-pelayanan" class="hover:text-emerald-700">Jam Pelayanan</a>
            <a href="{{ route('news.index') }}" class="hover:text-emerald-700">Berita</a>
            <a href="{{ route('home') }}#galeri" class="hover:text-emerald-700">Galeri</a>
            <a href="{{ route('home') }}#lokasi" class="hover:text-emerald-700">Lokasi</a>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="mt-0 bg-slate-900 text-slate-300">
    <div class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-8 text-sm sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="font-semibold text-white">{{ config('puskesmas.name') }}</p>
            <p>{{ config('puskesmas.address') }}</p>
        </div>
        <div class="flex items-center gap-4">
            <p>&copy; {{ date('Y') }} {{ config('puskesmas.name') }}</p>
            <a href="{{ route('login') }}" class="text-slate-500 hover:text-white">Admin</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@stack('scripts')
</body>
</html>