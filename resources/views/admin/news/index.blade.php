@extends('layouts.admin')

@section('title', 'Berita')
@section('heading', 'Kelola Berita')

@section('content')
<a href="{{ route('admin.news.create') }}"
   class="mb-6 inline-block rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">+ Berita Baru</a>

<div class="overflow-x-auto rounded-xl bg-white shadow-sm">
    <table class="w-full text-left text-sm">
        <thead class="border-b bg-slate-50 text-slate-500">
            <tr>
                <th class="px-4 py-3">Foto</th>
                <th class="px-4 py-3">Judul</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $item)
                <tr class="border-b last:border-0">
                    <td class="px-4 py-3">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="" class="h-12 w-16 rounded object-cover">
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium">{{ $item->title }}<div class="text-xs text-slate-400">/berita/{{ $item->slug }}</div></td>
                    <td class="px-4 py-3 text-slate-500">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.news.edit', $item) }}" class="text-emerald-700 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.news.destroy', $item) }}" class="ml-3 inline"
                              onsubmit="return confirm('Hapus berita ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-8 text-center text-slate-400">Belum ada berita.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $news->links() }}</div>
@endsection