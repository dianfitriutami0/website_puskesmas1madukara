@extends('layouts.public')

@section('title', $news->title . ' - ' . config('puskesmas.name'))

@push('styles')
<style>
    /* =========================================================
       ARTICLE PAGE SPECIFIC STYLES
    ========================================================= */
    .article-page {
        padding-top: 40px;
        padding-bottom: 80px;
    }

    /* Breadcrumb */
    .breadcrumb-nav {
        margin-bottom: 24px;
    }

    .breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: var(--mint);
        border-radius: 999px;
        font-size: 13px;
        color: var(--muted);
    }

    .breadcrumb a {
        color: var(--primary-color);
        font-weight: 500;
        transition: color 0.2s;
    }

    .breadcrumb a:hover {
        color: var(--primary-dark);
    }

    .breadcrumb i {
        font-size: 10px;
        color: var(--muted);
    }

    /* Article Container */
    .article-container {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Article Header */
    .article-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .article-category {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: var(--mint);
        color: var(--primary-color);
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .article-title {
        font-family: 'League Spartan', sans-serif;
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 800;
        color: var(--ink);
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .article-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        color: var(--muted);
        font-size: 13px;
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .article-meta-item i {
        color: var(--primary-color);
    }

    .article-meta-divider {
        width: 4px;
        height: 4px;
        background: var(--line);
        border-radius: 50%;
    }

    /* Featured Image */
    .article-featured-image {
        margin-bottom: 40px;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .article-featured-image img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.6s var(--ease);
    }

    .article-featured-image:hover img {
        transform: scale(1.02);
    }

    /* Article Content */
    .article-content {
        background: #fff;
        border-radius: var(--radius);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(4, 120, 87, 0.08);
    }

    .article-content p {
        font-size: 15px;
        line-height: 1.85;
        color: #475569;
        margin-bottom: 20px;
    }

    .article-content p:last-child {
        margin-bottom: 0;
    }

    .article-content strong {
        color: var(--ink);
        font-weight: 600;
    }

    /* Share Section */
    .article-share {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid var(--line);
    }

    .share-label {
        font-size: 14px;
        font-weight: 600;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .share-label i {
        color: var(--primary-color);
    }

    .share-buttons {
        display: flex;
        gap: 10px;
    }

    .share-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        transition: all 0.25s var(--ease);
        border: none;
        cursor: pointer;
    }

    .share-btn:hover {
        transform: translateY(-3px) scale(1.1);
    }

    .share-btn.whatsapp { background: #25D366; }
    .share-btn.whatsapp:hover { box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4); }

    .share-btn.facebook { background: #1877F2; }
    .share-btn.facebook:hover { box-shadow: 0 6px 20px rgba(24, 119, 242, 0.4); }

    .share-btn.twitter { background: #1DA1F2; }
    .share-btn.twitter:hover { box-shadow: 0 6px 20px rgba(29, 161, 242, 0.4); }

    .share-btn.link {
        background: var(--primary-color);
    }
    .share-btn.link:hover { box-shadow: 0 6px 20px rgba(4, 120, 87, 0.4); }

    .share-btn.copy {
        background: var(--muted);
    }
    .share-btn.copy:hover { box-shadow: 0 6px 20px rgba(100, 116, 139, 0.4); }

    /* Related Articles */
    .related-section {
        margin-top: 80px;
    }

    .related-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .related-title {
        font-family: 'League Spartan', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .related-title::before {
        content: '';
        width: 4px;
        height: 28px;
        background: linear-gradient(180deg, var(--primary-color), var(--teal));
        border-radius: 4px;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    @media (max-width: 992px) {
        .related-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .related-grid {
            grid-template-columns: 1fr;
        }
    }

    .related-card {
        background: #fff;
        border-radius: var(--radius);
        overflow: hidden;
        text-decoration: none;
        border: 1px solid rgba(4, 120, 87, 0.1);
        box-shadow: var(--shadow-sm);
        transition: all 0.35s var(--ease);
    }

    .related-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .related-card-image {
        height: 160px;
        overflow: hidden;
        background: var(--mint);
    }

    .related-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s var(--ease);
    }

    .related-card:hover .related-card-image img {
        transform: scale(1.08);
    }

    .related-card-body {
        padding: 20px;
    }

    .related-card-date {
        font-size: 12px;
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .related-card-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--ink);
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s;
    }

    .related-card:hover .related-card-title {
        color: var(--primary-color);
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #fff;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.25s var(--ease);
        margin-bottom: 32px;
    }

    .back-button:hover {
        background: var(--primary-color);
        color: #fff;
        transform: translateX(-4px);
    }

    /* Toast Notification */
    .toast {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: var(--ink);
        color: #fff;
        padding: 14px 24px;
        border-radius: var(--radius-sm);
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.4s var(--ease);
        z-index: 1000;
    }

    .toast.show {
        transform: translateY(0);
        opacity: 1;
    }

    .toast i {
        color: var(--success);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .article-content {
            padding: 24px;
        }

        .article-share {
            flex-direction: column;
            gap: 16px;
        }

        .article-meta {
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')
<article class="article-page">
    <div class="article-container">
        {{-- Breadcrumb --}}
        <nav class="breadcrumb-nav">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <i class="fa-solid fa-chevron-right"></i>
                <a href="{{ route('news.index') }}">Berita</a>
                <i class="fa-solid fa-chevron-right"></i>
                <span>{{ Str::limit($news->title, 30) }}</span>
            </div>
        </nav>

        {{-- Header --}}
        <header class="article-header">
            <span class="article-category">
                <i class="fa-solid fa-newspaper"></i>
                Berita
            </span>
            <h1 class="article-title">{{ $news->title }}</h1>
            <div class="article-meta">
                <span class="article-meta-item">
                    <i class="fa-solid fa-calendar-day"></i>
                    {{ $news->created_at->translatedFormat('d F Y') }}
                </span>
                <span class="article-meta-divider"></span>
                <span class="article-meta-item">
                    <i class="fa-regular fa-clock"></i>
                    {{ $news->created_at->format('H:i') }} WIB
                </span>
            </div>
        </header>

        {{-- Featured Image --}}
        @if ($news->image)
            <div class="article-featured-image">
                <img src="{{ asset('storage/' . $news->image) }}"
                     alt="{{ $news->title }}"
                     loading="lazy">
            </div>
        @endif

        {{-- Article Content --}}
        <div class="article-content">
            <div class="article-text">
                {!! nl2br(e($news->content)) !!}
            </div>

            {{-- Share Section --}}
            <div class="article-share">
                <span class="share-label">
                    <i class="fa-solid fa-share-nodes"></i>
                    Bagikan artikel ini:
                </span>
                <div class="share-buttons">
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . config('puskesmas.name')) }}"
                       target="_blank"
                       class="share-btn whatsapp"
                       title="Bagikan ke WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank"
                       class="share-btn facebook"
                       title="Bagikan ke Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}"
                       target="_blank"
                       class="share-btn twitter"
                       title="Bagikan ke Twitter">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <button onclick="copyLink()" class="share-btn copy" title="Salin tautan">
                        <i class="fa-solid fa-link"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Related Articles --}}
        @if ($others->isNotEmpty())
            <section class="related-section">
                <div class="related-header">
                    <h2 class="related-title">Berita Lainnya</h2>
                </div>
                <div class="related-grid">
                    @foreach ($others as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="related-card">
                            <div class="related-card-image">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : $placeholder }}"
                                     alt="{{ $item->title }}"
                                     loading="lazy">
                            </div>
                            <div class="related-card-body">
                                <div class="related-card-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                </div>
                                <h3 class="related-card-title">{{ $item->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</article>

{{-- Toast Notification --}}
<div class="toast" id="toast">
    <i class="fa-solid fa-check-circle"></i>
    <span>Tautan berhasil disalin!</span>
</div>
@endsection

@push('scripts')
<script>
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            showToast();
        });
    }

    function showToast() {
        const toast = document.getElementById('toast');
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }
</script>
@endpush
