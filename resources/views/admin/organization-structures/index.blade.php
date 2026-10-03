@extends('layouts.admin')

@section('title', 'Struktur Organisasi')
@section('heading', 'Struktur Organisasi')
@section('breadcrumb', 'Struktur Organisasi')

@section('content')
<form action="{{ route('admin.organization-structures.update', $structure) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-sitemap"></i>
                Gambar Struktur Organisasi
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $structure->title) }}">
            </div>

            <div class="form-group">
                <label for="image">Gambar Struktur Organisasi</label>
                @if($structure->image)
                    <div style="margin-bottom: 16px;">
                        <img src="{{ Storage::url($structure->image) }}" alt="Struktur Organisasi" style="max-width: 100%; max-height: 400px; border-radius: 12px; box-shadow: var(--shadow-md);">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <small class="form-hint">Format: JPG, PNG, GIF, SVG. Maksimal 5MB</small>
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 12px; justify-content: flex-end;">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-save"></i>
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
