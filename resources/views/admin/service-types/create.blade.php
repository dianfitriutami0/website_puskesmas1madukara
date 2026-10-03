@extends('layouts.admin')

@section('title', 'Tambah Jenis Layanan')
@section('heading', 'Jenis Layanan')
@section('breadcrumb', 'Tambah Jenis Layanan')

@section('content')
<form action="{{ route('admin.service-types.store') }}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-plus"></i>
                Tambah Jenis Layanan Baru
            </h2>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="nama">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto-generate dari nama">
                    <small class="form-hint">Biarkan kosong untuk generate otomatis dari nama</small>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="icon">Icon (Font Awesome)</label>
                    <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon', 'fa-stethoscope') }}" placeholder="fa-stethoscope">
                    <small class="form-hint">Contoh: fa-stethoscope, fa-heartbeat, fa-syringe</small>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-group">
                <label for="konten">Konten Lengkap</label>
                <textarea name="konten" id="konten" class="form-control" rows="10">{{ old('konten') }}</textarea>
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 24px;">
        <a href="{{ route('admin.service-types.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-save"></i>
            Simpan
        </button>
    </div>
</form>
@endsection
