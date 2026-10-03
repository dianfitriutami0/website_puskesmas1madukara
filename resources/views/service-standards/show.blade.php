@extends('layouts.public')

@section('title', $service->nama . ' - ' . config('puskesmas.name'))

@push('styles')
<style>
    .service-detail-page {
        padding: 40px 5% 80px;
    }

    .service-container {
        max-width: 900px;
        margin: 0 auto;
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

    /* Service Header */
    .service-header {
        background: #fff;
        border-radius: var(--radius);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(4, 120, 87, 0.08);
        margin-bottom: 32px;
        text-align: center;
    }

    .service-icon-large {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--mint), #fff);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        box-shadow: var(--shadow-md);
    }

    .service-icon-large i {
        font-size: 40px;
        color: var(--primary-color);
    }

    .service-header h1 {
        font-family: 'League Spartan', sans-serif;
        font-size: clamp(28px, 4vw, 36px);
        font-weight: 800;
        color: var(--ink);
        margin-bottom: 16px;
    }

    .service-header p {
        font-size: 16px;
        color: var(--muted);
        line-height: 1.7;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Service Content */
    .service-content {
        background: #fff;
        border-radius: var(--radius);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(4, 120, 87, 0.08);
        margin-bottom: 32px;
    }

    .service-content h2 {
        font-family: 'League Spartan', sans-serif;
        font-size: 22px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--line);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .service-content h2 i {
        color: var(--primary-color);
    }

    .service-content p {
        font-size: 15px;
        line-height: 1.85;
        color: #475569;
        margin-bottom: 16px;
    }

    .service-content ul {
        margin: 20px 0;
        padding-left: 24px;
    }

    .service-content li {
        font-size: 15px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 8px;
        position: relative;
    }

    .service-content li::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 10px;
        width: 8px;
        height: 8px;
        background: var(--primary-color);
        border-radius: 50%;
    }

    /* Related Services */
    .related-section {
        margin-top: 48px;
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
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    @media (max-width: 640px) {
        .related-grid {
            grid-template-columns: 1fr;
        }
    }

    .related-card {
        background: #fff;
        border-radius: var(--radius-sm);
        padding: 20px;
        text-decoration: none;
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s var(--ease);
    }

    .related-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-4px);
    }

    .related-icon {
        width: 50px;
        height: 50px;
        background: var(--mint);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .related-icon i {
        font-size: 20px;
        color: var(--primary-color);
    }

    .related-card h4 {
        font-size: 15px;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 4px;
    }

    .related-card p {
        font-size: 12px;
        color: var(--muted);
    }
</style>
@endpush

@section('content')
<div class="service-detail-page">
    <div class="service-container">
        {{-- Breadcrumb --}}
        <nav class="breadcrumb-nav">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <i class="fa-solid fa-chevron-right"></i>
                <a href="{{ route('service-standards.index') }}">Standar Layanan</a>
                <i class="fa-solid fa-chevron-right"></i>
                <span>{{ $service->nama }}</span>
            </div>
        </nav>

        {{-- Back Button --}}
        <a href="{{ route('service-standards.index') }}" class="back-button">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Standar Layanan
        </a>

        {{-- Service Header --}}
        <header class="service-header">
            <div class="service-icon-large">
                <i class="fa-solid {{ $service->icon ?? 'fa-hand-holding-medical' }}"></i>
            </div>
            <h1>{{ $service->nama }}</h1>
            <p>{{ $service->deskripsi ?? 'Pelayanan kesehatan profesional di Puskesmas Madukara 1 Kabupaten Banjarnegara.' }}</p>
        </header>

        {{-- Service Content --}}
        <article class="service-content">
            <h2>
                <i class="fa-solid fa-file-lines"></i>
                Detail Standar Pelayanan
            </h2>

            @if($service->konten)
                {!! nl2br(e($service->konten)) !!}
            @else
                <p>Informasi detail tentang standar pelayanan ini sedang dalam pengembangan. Silakan hubungi kami untuk informasi lebih lanjut.</p>
            @endif
        </article>

        {{-- Related Services --}}
        @if($otherServices->isNotEmpty())
            <section class="related-section">
                <div class="related-header">
                    <h2 class="related-title">Layanan Lainnya</h2>
                </div>
                <div class="related-grid">
                    @foreach($otherServices as $other)
                        <a href="{{ route('service-standards.show', $other->slug) }}" class="related-card">
                            <div class="related-icon">
                                <i class="fa-solid {{ $other->icon ?? 'fa-circle' }}"></i>
                            </div>
                            <div>
                                <h4>{{ $other->nama }}</h4>
                                <p>{{ Str::limit($other->deskripsi, 50) ?? 'Lihat detail' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
@endsection
