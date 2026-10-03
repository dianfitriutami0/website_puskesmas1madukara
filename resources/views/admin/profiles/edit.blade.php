@extends('layouts.admin')

@section('title', 'Profil - Visi Misi & Tata Nilai')
@section('heading', 'Profil')
@section('breadcrumb', 'Profil')

@section('content')
<form action="{{ route('admin.profiles.update', $profile) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-building"></i>
                Konten Profil
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="konten">Deskripsi Profil</label>
                <textarea name="konten" id="konten" class="form-control" rows="8">{{ old('konten', $profile->konten) }}</textarea>
                <small class="form-hint">Jelaskan tentang Puskesmas Madukara 1</small>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-eye"></i>
                Visi
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="visi">Visi Puskesmas</label>
                <textarea name="visi" id="visi" class="form-control" rows="5">{{ old('visi', $profile->visi) }}</textarea>
                <small class="form-hint">Tuliskan visi jangka panjang Puskesmas</small>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-bullseye"></i>
                Misi
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="misi">Misi Puskesmas</label>
                <textarea name="misi" id="misi" class="form-control" rows="6">{{ old('misi', $profile->misi) }}</textarea>
                <small class="form-hint">Tuliskan misi untuk mencapai visi</small>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fa-solid fa-heart"></i>
                Tata Nilai
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="tata_nilai">Tata Nilai Puskesmas</label>
                <textarea name="tata_nilai" id="tata_nilai" class="form-control" rows="6">{{ old('tata_nilai', $profile->tata_nilai) }}</textarea>
                <small class="form-hint">Tuliskan nilai-nilai yang dipegang teguh</small>
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
