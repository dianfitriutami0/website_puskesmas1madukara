@extends('layouts.admin')

@section('title', 'Slider Utama')
@section('heading', 'Slider Utama (4 Gambar)')

@section('content')
<p class="mb-6 text-sm text-slate-500">Unggah gambar untuk setiap slot. Format JPG/PNG/WebP, maksimal 3 MB. Disarankan rasio lebar (mis. 1600x600).</p>

<div class="grid gap-6 md:grid-cols-2">
    @foreach ([1, 2, 3, 4] as $pos)
        @php $slide = $sliders->get($pos); @endphp
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <h2 class="mb-3 font-semibold">Slot {{ $pos }}</h2>

            @if ($slide)
                <img src="{{ asset('storage/' . $slide->image) }}" alt="Slide {{ $pos }}" class="mb-4 h-40 w-full rounded-lg object-cover">
            @else
                <div class="mb-4 flex h-40 items-center justify-center rounded-lg bg-slate-100 text-sm text-slate-400">Belum ada gambar</div>
            @endif

            <form method="POST" action="{{ route('admin.sliders.upsert', $pos) }}" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <input type="text" name="title" value="{{ $slide->title ?? '' }}" placeholder="Judul/caption (opsional)"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <input type="file" name="image" accept="image/*" {{ $slide ? '' : 'required' }}
                       class="block w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-2 file:text-emerald-700">
                <button class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                    {{ $slide ? 'Ganti / Simpan' : 'Unggah' }}
                </button>
            </form>

            @if ($slide)
                <form method="POST" action="{{ route('admin.sliders.destroy', $pos) }}" class="mt-2"
                      onsubmit="return confirm('Hapus slide ini?')">
                    @csrf @method('DELETE')
                    <button class="text-sm text-red-600 hover:underline">Hapus</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection