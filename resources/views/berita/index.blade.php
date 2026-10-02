@extends('layouts.public')

@section('title', 'Berita - ' . config('puskesmas.name'))

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
    <h1 class="mb-8 text-3xl font-bold text-slate-900">Berita Puskesmas</h1>

    @if ($news->isEmpty())
        <p class="text-slate-500">Belum ada berita.</p>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($news as $item)
                <a href="{{ route('news.show', $item->slug) }}"
                   class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition hover:shadow-md">
                    @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-48 w-full object-cover">
                    @endif
                    <div class="p-5">
                        <time class="text-xs font-medium text-emerald-700">{{ $item->created_at->translatedFormat('d F Y') }}</time>
                        <h2 class="mt-2 line-clamp-2 text-lg font-bold text-slate-900">{{ $item->title }}</h2>
                        <p class="mt-2 line-clamp-3 text-sm text-slate-600">{{ $item->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-10">{{ $news->links() }}</div>
    @endif
</section>
@endsection