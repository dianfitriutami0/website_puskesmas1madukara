@extends('layouts.public')

@section('title', $news->title . ' - ' . config('puskesmas.name'))

@section('content')
<article class="mx-auto max-w-3xl px-4 py-12">
    <a href="{{ route('news.index') }}" class="text-sm font-medium text-emerald-700 hover:underline">&larr; Semua berita</a>
    <h1 class="mt-4 text-3xl font-bold text-slate-900">{{ $news->title }}</h1>
    <time class="mt-2 block text-sm text-slate-500">{{ $news->created_at->translatedFormat('l, d F Y') }}</time>

    @if ($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="mt-6 w-full rounded-2xl object-cover shadow">
    @endif

    <div class="mt-8 leading-relaxed text-slate-700">{!! nl2br(e($news->content)) !!}</div>
</article>

@if ($others->isNotEmpty())
    <section class="mx-auto max-w-6xl px-4 pb-16">
        <h2 class="mb-6 text-xl font-bold text-slate-900">Berita lainnya</h2>
        <div class="grid gap-6 sm:grid-cols-3">
            @foreach ($others as $item)
                <a href="{{ route('news.show', $item->slug) }}" class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200 hover:shadow-md">
                    <time class="text-xs text-emerald-700">{{ $item->created_at->translatedFormat('d F Y') }}</time>
                    <p class="mt-1 line-clamp-2 font-semibold text-slate-900">{{ $item->title }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endif
@endsection