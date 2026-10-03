@extends('layouts.admin')

@section('title', 'Sambutan Kepala Puskesmas')
@section('heading', 'Sambutan Kepala Puskesmas')
@section('breadcrumb', 'Sambutan')

@section('content')
<form method="POST" action="{{ route('admin.sambutan.update') }}" enctype="multipart/form-data"
      class="card" style="max-width: 800px;">
    @csrf @method('PUT')

    <div class="card-header">
        <h2 class="card-title">
            <i class="fa-solid fa-user-tie"></i>
            Edit Sambutan
        </h2>
    </div>

    {{-- Photo Upload --}}
    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-camera" style="margin-right: 6px; color: var(--muted);"></i>
            Foto Kepala Puskesmas
        </label>
        @if ($sambutan->foto)
            <div style="margin-bottom: 16px; border-radius: var(--radius-sm); overflow: hidden; height: 200px; max-width: 300px;">
                <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="Foto Kepala Puskesmas"
                     style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
            </div>
        @endif
        <input type="file" name="foto" accept="image/*"
               class="form-input" style="padding: 10px;">
        <p class="form-hint">Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.</p>
    </div>

    {{-- Name Fields --}}
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px;">
        <div class="form-group">
            <label class="form-label">
                <i class="fa-solid fa-user" style="margin-right: 6px; color: var(--muted);"></i>
                Nama Lengkap
            </label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $sambutan->nama_lengkap) }}" required
                   placeholder="Contoh: dr. John Doe"
                   class="form-input">
        </div>
        <div class="form-group">
            <label class="form-label">
                <i class="fa-solid fa-certificate" style="margin-right: 6px; color: var(--muted);"></i>
                Gelar
            </label>
            <input type="text" name="gelar" value="{{ old('gelar', $sambutan->gelar) }}"
                   placeholder="Contoh: M.Kes"
                   class="form-input">
        </div>
    </div>

    {{-- Position --}}
    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-briefcase" style="margin-right: 6px; color: var(--muted);"></i>
            Jabatan
        </label>
        <input type="text" name="jabatan" value="{{ old('jabatan', $sambutan->jabatan) }}" required
               placeholder="Contoh: Kepala Puskesmas Madukara 1"
               class="form-input">
    </div>

    {{-- Sambutan Text --}}
    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-quote-left" style="margin-right: 6px; color: var(--muted);"></i>
            Teks Sambutan
        </label>
        <textarea name="sambutan" rows="10" required
                  placeholder="Tuliskan teks sambutan di sini..."
                  class="form-input">{{ old('sambutan', $sambutan->sambutan) }}</textarea>
        <p class="form-hint">
            <i class="fa-solid fa-lightbulb" style="margin-right: 4px;"></i>
            Tips: Tambahkan baris yang diawali dengan tanda ">" untuk kutipan khusus yang akan ditampilkan dalam kotak.
        </p>
    </div>

    {{-- Submit --}}
    <div style="display: flex; gap: 12px; padding-top: 8px;">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i>
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
