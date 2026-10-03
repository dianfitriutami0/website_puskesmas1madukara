@extends('layouts.public')

@section('title', 'Berita - ' . config('puskesmas.name'))

@push('styles')
<style>
    /* =========================================================
       NEWS LISTING PAGE
    ========================================================= */
    .news-page {
        padding: 48px 5%;
        min-height: 70vh;
    }

    .news-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Page Header */
    .page-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .page-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: var(--mint);
        color: var(--primary-color);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .page-header h1 {
        font-family: 'League Spartan', sans-serif;
        font-size: clamp(32px, 4vw, 44px);
        font-weight: 800;
        color: var(--ink);
        margin-bottom: 12px;
        position: relative;
        display: inline-block;
    }

    .page-header h1::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--sky));
        border-radius: 4px;
    }

    .page-header p {
        max-width: 600px;
        margin: 20px auto 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.7;
    }

    /* News Grid */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-bottom: 48px;
    }

    @media (max-width: 992px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .news-grid {
            grid-template-columns: 1fr;
        }
    }

    /* News Card */
    .news-card {
        background: #fff;
        border-radius: var(--radius);
        overflow: hidden;
        text-decoration: none;
        border: 1px solid rgba(4, 120, 87, 0.08);
        box-shadow: var(--shadow-sm);
        transition: all 0.4s var(--ease);
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .news-card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: var(--mint);
    }

    .news-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s var(--ease);
    }

    .news-card:hover .news-card-image img {
        transform: scale(1.08);
    }

    .news-card-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        padding: 6px 12px;
        background: rgba(255, 255, 255, 0.95);
        color: var(--primary-color);
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
    }

    .news-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: linear-gradient(to top, rgba(2, 44, 34, 0.5), transparent);
        pointer-events: none;
    }

    .news-card-date {
        position: absolute;
        bottom: 14px;
        left: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
    }

    .news-card-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .news-card-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.4;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s;
    }

    .news-card:hover .news-card-title {
        color: var(--primary-color);
    }

    .news-card-excerpt {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.7;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 16px;
    }

    .news-card-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--primary-color);
        transition: all 0.3s var(--ease);
    }

    .news-card-cta i {
        transition: transform 0.3s var(--ease);
    }

    .news-card:hover .news-card-cta {
        gap: 12px;
    }

    .news-card:hover .news-card-cta i {
        transform: translateX(4px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 24px;
        background: #fff;
        border-radius: var(--radius);
        border: 2px dashed var(--line);
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: var(--mint);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .empty-state-icon i {
        font-size: 32px;
        color: var(--primary-color);
    }

    .empty-state h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: var(--muted);
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 48px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 6px;
    }

    .pagination a,
    .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        height: 44px;
        padding: 0 16px;
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-weight: 500;
        color: var(--muted);
        background: #fff;
        border: 1px solid var(--line);
        transition: all 0.25s var(--ease);
    }

    .pagination a:hover {
        background: var(--mint);
        color: var(--primary-color);
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }

    .pagination .active {
        background: var(--primary-color);
        color: #fff;
        border-color: var(--primary-color);
    }

    .pagination .disabled {
        opacity: 0.5;
        pointer-events: none;
    }
</style>
@endpush

@section('content')
<div class="news-page">
    <div class="news-container">
        {{-- Page Header --}}
        <header class="page-header">
            <span class="page-header-badge">
                <i class="fa-solid fa-newspaper"></i>
                Informasi Terkini
            </span>
            <h1>Berita & Kegiatan</h1>
            <p>Ikuti informasi terbaru seputar kegiatan dan pelayanan di Puskesmas Madukara 1 Kabupaten Banjarnegara.</p>
        </header>

        {{-- News Grid --}}
        @if ($news->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <h3>Belum Ada Berita</h3>
                <p>Saat ini belum ada berita atau kegiatan yang dipublikasikan.</p>
            </div>
        @else
            <div class="news-grid">
                @foreach ($news as $item)
                    <a href="{{ route('news.show', $item->slug) }}" class="news-card">
                        <div class="news-card-image">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy">
                            @endif
                            <span class="news-card-badge">
                                <i class="fa-solid fa-tag"></i>
                                Berita
                            </span>
                            <div class="news-card-overlay"></div>
                            <div class="news-card-date">
                                <i class="fa-regular fa-calendar"></i>
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>
                        <div class="news-card-body">
                            <h2 class="news-card-title">{{ $item->title }}</h2>
                            <p class="news-card-excerpt">{{ $item->excerpt }}</p>
                            <span class="news-card-cta">
                                Baca selengkapnya
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($news->hasPages())
                <div class="pagination-wrapper">
                    {{ $news->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
