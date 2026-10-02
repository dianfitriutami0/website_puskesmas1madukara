<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Admin {{ config('puskesmas.name') }}</title>
   
</head>
<body class="bg-slate-100 text-slate-800">
@php
    $menus = [
        ['admin.dashboard',     'Dashboard',        'admin.dashboard'],
        ['admin.sliders.index', 'Slider Utama',     'admin.sliders.*'],
        ['admin.sambutan.edit', 'Sambutan Kepala',  'admin.sambutan.*'],
        ['admin.hours.edit',    'Jam Pelayanan',    'admin.hours.*'],
        ['admin.news.index',    'Berita',           'admin.news.*'],
        ['admin.gallery.index', 'Galeri',           'admin.gallery.*'],
    ];
@endphp

<div class="flex min-h-screen flex-col md:flex-row">
    <aside class="bg-emerald-800 text-emerald-50 md:w-60 md:shrink-0">
        <div class="px-5 py-4 text-lg font-bold">Admin Puskesmas</div>
        <nav class="flex gap-1 overflow-x-auto px-3 pb-3 md:flex-col md:pb-0">
            @foreach ($menus as [$route, $label, $pattern])
                <a href="{{ route($route) }}"
                   class="whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs($pattern) ? 'bg-emerald-600 text-white' : 'hover:bg-emerald-700' }}">
                    {{ $label }}
                </a>
            @endforeach
            <a href="{{ route('home') }}" target="_blank" class="whitespace-nowrap rounded-lg px-3 py-2 text-sm hover:bg-emerald-700">Lihat Website &nearr;</a>
            <form method="POST" action="{{ route('logout') }}" class="md:mt-4">
                @csrf
                <button class="w-full whitespace-nowrap rounded-lg px-3 py-2 text-left text-sm hover:bg-emerald-700">Keluar</button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 p-4 sm:p-8">
        <h1 class="mb-6 text-2xl font-bold">@yield('heading')</h1>

        @if (session('success'))
            <div class="mb-6 rounded-lg bg-emerald-100 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>