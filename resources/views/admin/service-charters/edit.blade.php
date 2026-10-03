@extends('layouts.admin')

@section('title', 'Maklumat Layanan')
@section('heading', 'Maklumat Layanan')
@section('breadcrumb', 'Maklumat Layanan')

@section('content')
<form action="{{ route('admin.service-charters.update', $charter) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-scroll"></i>
                Maklumat Layanan
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $charter->title) }}">
            </div>

            <div class="form-group">
                <label for="konten">Konten Maklumat</label>
                <textarea name="konten" id="konten" class="form-control" rows="15">{{ old('konten', $charter->konten) }}</textarea>
                <small class="form-hint">Tuliskan maklumat/janji layanan kepada masyarakat</small>
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 24px;">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-save"></i>
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
