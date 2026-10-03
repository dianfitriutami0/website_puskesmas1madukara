@extends('layouts.admin')

@section('title', 'Mutu Pelayanan')
@section('heading', 'Mutu Pelayanan')
@section('breadcrumb', 'Mutu Pelayanan')

@section('content')
<form action="{{ route('admin.service-qualities.update', $quality) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-award"></i>
                Mutu Pelayanan
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $quality->title) }}">
            </div>

            <div class="form-group">
                <label for="konten">Konten Mutu Pelayanan</label>
                <textarea name="konten" id="konten" class="form-control" rows="15">{{ old('konten', $quality->konten) }}</textarea>
                <small class="form-hint">Jelaskan standar dan komitmen mutu pelayanan</small>
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
