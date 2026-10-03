@extends('layouts.admin')

@section('title', 'Berita & Kegiatan')
@section('heading', 'Kelola Berita')
@section('breadcrumb', 'Berita')

@section('content')
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Berita Baru
        </a>
    </div>
    <p style="font-size: 13px; color: var(--muted);">
        Total: {{ $news->total() }} berita
    </p>
</div>

@if ($news->isEmpty())
    <div class="empty-state" style="background: #fff; padding: 60px 24px;">
        <i class="fa-regular fa-newspaper" style="font-size: 48px; color: var(--muted); margin-bottom: 16px;"></i>
        <h3 style="font-size: 18px; color: var(--ink); margin-bottom: 8px;">Belum Ada Berita</h3>
        <p style="font-size: 14px; color: var(--muted); margin-bottom: 20px;">Klik tombol di atas untuk membuat berita pertama.</p>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Buat Berita Baru
        </a>
    </div>
@else
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Foto</th>
                    <th>Judul</th>
                    <th style="width: 120px;">Tanggal</th>
                    <th style="width: 140px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="" class="thumb">
                            @else
                                <div class="thumb" style="background: var(--bg-light); display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-image" style="color: var(--muted);"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <p style="font-weight: 600; color: var(--ink); margin-bottom: 4px;">{{ $item->title }}</p>
                            <p style="font-size: 12px; color: var(--muted);">
                                <i class="fa-solid fa-link" style="margin-right: 4px;"></i>
                                /berita/{{ $item->slug }}
                            </p>
                        </td>
                        <td>
                            <span style="font-size: 13px; color: var(--muted);">
                                {{ $item->created_at->format('d/m/Y') }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.news.edit', $item) }}" class="action-link action-edit">
                                <i class="fa-solid fa-pen"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.news.destroy', $item) }}" style="display: inline;"
                                  onsubmit="return confirm('Hapus berita ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-link action-delete">
                                    <i class="fa-solid fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($news->hasPages())
        <div class="pagination-wrapper">
            {{ $news->links() }}
        </div>
    @endif
@endif
@endsection
