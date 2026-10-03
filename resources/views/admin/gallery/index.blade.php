@extends('layouts.admin')

@section('title', 'Galeri Foto')
@section('heading', 'Galeri Dokumentasi')
@section('breadcrumb', 'Galeri')

@section('content')
{{-- Upload Form --}}
<div class="card" style="margin-bottom: 32px;">
    <div class="card-header">
        <h2 class="card-title">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            Upload Foto Baru
        </h2>
    </div>

    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Keterangan (opsional)</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       placeholder="Contoh: Kegiatan Posyandu"
                       class="form-input">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">File Foto</label>
                <input type="file" name="photos[]" accept="image/*" multiple required
                       class="form-input" style="padding: 10px;">
            </div>
        </div>
        <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 16px;">
            <p style="font-size: 12px; color: var(--muted);">
                <i class="fa-solid fa-info-circle" style="margin-right: 4px;"></i>
                Maksimal 10 file sekaligus, 3 MB per file.
            </p>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i>
                Upload
            </button>
        </div>
    </form>
</div>

{{-- Gallery Grid --}}
@if ($photos->isEmpty())
    <div class="empty-state">
        <i class="fa-regular fa-images" style="font-size: 48px; color: var(--muted); margin-bottom: 16px;"></i>
        <h3 style="font-size: 18px; color: var(--ink); margin-bottom: 8px;">Belum Ada Foto</h3>
        <p style="font-size: 14px; color: var(--muted);">Upload foto pertama Anda menggunakan form di atas.</p>
    </div>
@else
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
        @foreach ($photos as $photo)
            <div class="card" style="padding: 0; overflow: hidden;">
                <div style="height: 180px; overflow: hidden; background: var(--bg-light);">
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s var(--ease);"
                         class="gallery-img">
                </div>
                <div style="padding: 14px 16px;">
                    <p style="font-size: 13px; color: var(--ink); font-weight: 500; margin-bottom: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $photo->title ?? '-' }}
                    </p>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-size: 11px; color: var(--muted);">
                            {{ $photo->created_at->format('d/m/Y') }}
                        </span>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $photo) }}"
                              onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($photos->hasPages())
        <div class="pagination-wrapper">
            {{ $photos->links() }}
        </div>
    @endif
@endif

<style>
    .gallery-img:hover {
        transform: scale(1.05);
    }
</style>
@endsection
