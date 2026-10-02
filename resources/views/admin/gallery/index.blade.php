@extends('layouts.admin')

@section('title', 'Galeri')
@section('heading', 'Galeri Dokumentasi')

@section('content')
<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data"
      class="mb-8 max-w-2xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
    @csrf
    <div>
        <label class="mb-1 block text-sm font-medium">Keterangan (opsional, berlaku untuk semua foto yang diunggah)</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Foto (maks 10 file, 3 MB per file)</label>
        <input type="file" name="photos[]" accept="image/*" multiple required
               class="block w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-2 file:text-emerald-700">
    </div>
    <button class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white hover:bg-emerald-700">Unggah</button>
    <p class="text-xs text-slate-400">Foto utama dari Berita otomatis ikut tampil di galeri website.</p>
</form>

<div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
    @forelse ($photos as $photo)
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
            <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="aspect-square w-full object-cover">
            <div class="flex items-center justify-between p-3 text-sm">
                <span class="truncate text-slate-600">{{ $photo->title ?? '-' }}</span>
                <form method="POST" action="{{ route('admin.gallery.destroy', $photo) }}" onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="col-span-full text-slate-400">Belum ada foto.</p>
    @endforelse
</div>
<div class="mt-6">{{ $photos->links() }}</div>
@endsection