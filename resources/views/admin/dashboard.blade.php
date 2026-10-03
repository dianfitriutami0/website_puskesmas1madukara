@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard Utama')
@section('breadcrumb', 'Overview')

@section('content')
{{-- Welcome Card --}}
<div class="card" style="margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 56px; height: 56px; background: var(--mint); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-hand-wave" style="font-size: 24px; color: var(--primary-color);"></i>
        </div>
        <div>
            <h3 style="font-size: 18px; font-weight: 700; color: var(--ink); margin-bottom: 4px;">
                Selamat Datang di Panel Pengelolaan
            </h3>
            <p style="font-size: 14px; color: var(--muted);">
                Pantau metrik data terkini dan kelola seluruh konten publikasi Puskesmas Madukara 1 secara terpadu.
            </p>
        </div>
    </div>
</div>

{{-- Stats Grid --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px;">
    {{-- Slider Stats --}}
    <a href="{{ route('admin.sliders.index') }}" class="card" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none;">
        <div>
            <p style="font-size: 13px; font-weight: 500; color: var(--muted); margin-bottom: 8px;">Slide Aktif</p>
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-color); line-height: 1;">
                {{ $sliderCount }}<span style="font-size: 18px; color: var(--muted);"> / 4</span>
            </div>
        </div>
        <div style="width: 56px; height: 56px; background: var(--mint); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-images" style="font-size: 24px; color: var(--primary-color);"></i>
        </div>
    </a>

    {{-- News Stats --}}
    <a href="{{ route('admin.news.index') }}" class="card" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none;">
        <div>
            <p style="font-size: 13px; font-weight: 500; color: var(--muted); margin-bottom: 8px;">Total Berita</p>
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-color); line-height: 1;">
                {{ $newsCount }}
            </div>
        </div>
        <div style="width: 56px; height: 56px; background: var(--mint); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-newspaper" style="font-size: 24px; color: var(--primary-color);"></i>
        </div>
    </a>

    {{-- Gallery Stats --}}
    <a href="{{ route('admin.gallery.index') }}" class="card" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none;">
        <div>
            <p style="font-size: 13px; font-weight: 500; color: var(--muted); margin-bottom: 8px;">Foto Galeri</p>
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-color); line-height: 1;">
                {{ $galleryCount }}
            </div>
        </div>
        <div style="width: 56px; height: 56px; background: var(--mint); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-photo-film" style="font-size: 24px; color: var(--primary-color);"></i>
        </div>
    </a>
</div>

{{-- Quick Actions --}}
<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <i class="fa-solid fa-bolt"></i>
            Aksi Cepat
        </h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <a href="{{ route('admin.sliders.index') }}" style="display: flex; align-items: center; gap: 14px; padding: 16px; background: var(--bg-light); border-radius: var(--radius-sm); text-decoration: none; transition: all 0.25s var(--ease);" class="quick-action-card">
            <div style="width: 44px; height: 44px; background: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
                <i class="fa-solid fa-images" style="color: var(--primary-color);"></i>
            </div>
            <div>
                <p style="font-size: 14px; font-weight: 600; color: var(--ink);">Kelola Slider</p>
                <p style="font-size: 12px; color: var(--muted);">Upload gambar hero</p>
            </div>
        </a>

        <a href="{{ route('admin.news.create') }}" style="display: flex; align-items: center; gap: 14px; padding: 16px; background: var(--bg-light); border-radius: var(--radius-sm); text-decoration: none; transition: all 0.25s var(--ease);" class="quick-action-card">
            <div style="width: 44px; height: 44px; background: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
                <i class="fa-solid fa-plus" style="color: var(--primary-color);"></i>
            </div>
            <div>
                <p style="font-size: 14px; font-weight: 600; color: var(--ink);">Buat Berita Baru</p>
                <p style="font-size: 12px; color: var(--muted);">Publikasikan artikel</p>
            </div>
        </a>

        <a href="{{ route('admin.sambutan.edit') }}" style="display: flex; align-items: center; gap: 14px; padding: 16px; background: var(--bg-light); border-radius: var(--radius-sm); text-decoration: none; transition: all 0.25s var(--ease);" class="quick-action-card">
            <div style="width: 44px; height: 44px; background: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
                <i class="fa-solid fa-user-pen" style="color: var(--primary-color);"></i>
            </div>
            <div>
                <p style="font-size: 14px; font-weight: 600; color: var(--ink);">Edit Sambutan</p>
                <p style="font-size: 12px; color: var(--muted);">Perbarui kata-kata</p>
            </div>
        </a>

        <a href="{{ route('admin.gallery.index') }}" style="display: flex; align-items: center; gap: 14px; padding: 16px; background: var(--bg-light); border-radius: var(--radius-sm); text-decoration: none; transition: all 0.25s var(--ease);" class="quick-action-card">
            <div style="width: 44px; height: 44px; background: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
                <i class="fa-solid fa-camera" style="color: var(--primary-color);"></i>
            </div>
            <div>
                <p style="font-size: 14px; font-weight: 600; color: var(--ink);">Upload Galeri</p>
                <p style="font-size: 12px; color: var(--muted);">Tambah foto dokumentasi</p>
            </div>
        </a>
    </div>
</div>

<style>
    .quick-action-card:hover {
        background: var(--mint) !important;
    }
</style>
@endsection
