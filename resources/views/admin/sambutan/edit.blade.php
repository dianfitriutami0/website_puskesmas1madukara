@extends('layouts.admin')

@section('title', 'Sambutan Kepala Puskesmas')
@section('heading', 'Sambutan Kepala Puskesmas')

@section('content')
<form method="POST" action="{{ route('admin.sambutan.update') }}" enctype="multipart/form-data"
      class="max-w-3xl space-y-5 rounded-xl bg-white p-6 shadow-sm">
    @csrf @method('PUT')

    <div>
        <label class="mb-1 block text-sm font-medium">Foto Kepala Puskesmas</label>
        @if ($sambutan->foto)
            <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="Foto" class="mb-3 h-40 rounded-lg object-cover">
        @endif
        <input type="file" name="foto" accept="image/*"
               class="block w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-2 file:text-emerald-700">
        <p class="mt-1 text-xs text-slate-400">Kosongkan jika tidak ingin mengganti foto. Maks 2 MB.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label class="mb-1 block text-sm font-medium">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $sambutan->nama_lengkap) }}" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Gelar</label>
            <input type="text" name="gelar" value="{{ old('gelar', $sambutan->gelar) }}" placeholder="mis. M.Kes"
                   class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Jabatan</label>
        <input type="text" name="jabatan" value="{{ old('jabatan', $sambutan->jabatan) }}" required
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Teks Sambutan</label>
        <textarea name="sambutan" rows="10" required
                  class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('sambutan', $sambutan->sambutan) }}</textarea>
    </div>

    <button class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white hover:bg-emerald-700">Simpan</button>
</form>
@endsection