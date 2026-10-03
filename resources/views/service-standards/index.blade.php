@extends('layouts.public')

@section('title', 'Standar Layanan - ' . config('puskesmas.name'))

@push('styles')
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        padding: 80px 5% 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 80%, rgba(255, 204, 0, 0.15) 0%, transparent 50%);
    }

    .page-header-content {
        position: relative;
        z-index: 1;
    }

    .page-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 16px;
    }

    .page-header h1 {
        font-family: 'League Spartan', sans-serif;
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
    }

    .page-header p {
        max-width: 600px;
        margin: 0 auto;
        color: rgba(255, 255, 255, 0.85);
        font-size: 16px;
        line-height: 1.7;
    }

    /* Services Grid */
    .services-section {
        padding: 60px 5%;
        background: var(--bg-light);
    }

    .services-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    @media (max-width: 992px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Service Card */
    .service-card {
        background: #fff;
        border-radius: var(--radius);
        padding: 28px;
        text-decoration: none;
        border: 1px solid rgba(4, 120, 87, 0.08);
        box-shadow: var(--shadow-sm);
        transition: all 0.4s var(--ease);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .service-icon {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, var(--mint), #fff);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.4s var(--ease);
    }

    .service-card:hover .service-icon {
        background: linear-gradient(135deg, var(--primary-color), var(--teal));
        transform: rotate(-5deg) scale(1.05);
    }

    .service-icon i {
        font-size: 28px;
        color: var(--primary-color);
        transition: color 0.4s;
    }

    .service-card:hover .service-icon i {
        color: #fff;
    }

    .service-card h3 {
        font-size: 18px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .service-card p {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.6;
        margin-bottom: 16px;
        flex: 1;
    }

    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--primary-color);
        transition: all 0.3s var(--ease);
    }

    .service-link i {
        transition: transform 0.3s var(--ease);
    }

    .service-card:hover .service-link {
        gap: 12px;
    }

    .service-card:hover .service-link i {
        transform: translateX(4px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 24px;
        background: #fff;
        border-radius: var(--radius);
        border: 2px dashed var(--line);
        max-width: 500px;
        margin: 40px auto;
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
</style>
@endpush

@section('content')
{{-- Header --}}
<section class="page-header">
    <div class="page-header-content">
        <span class="page-header-badge">
            <i class="fa-solid fa-list-check"></i>
            Informasi Layanan
        </span>
        <h1>Standar Layanan</h1>
        <p>Puskesmas Madukara 1 memberikan pelayanan kesehatan terbaik dengan standar yang telah ditetapkan untuk memenuhi kebutuhan masyarakat.</p>
    </div>
</section>

{{-- Services Section --}}
<section class="services-section">
    <div class="services-grid">
        @forelse($services as $service)
            <a href="{{ route('service-standards.show', $service->slug) }}" class="service-card">
                <div class="service-icon">
                    <i class="fa-solid {{ $service->icon ?? 'fa-hand-holding-medical' }}"></i>
                </div>
                <h3>{{ $service->nama }}</h3>
                <p>{{ $service->deskripsi ?? 'Pelayanan kesehatan profesional di Puskesmas Madukara 1.' }}</p>
                <span class="service-link">
                    Selengkapnya
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </a>
        @empty
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-state-icon">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <h3>Standar Layanan Belum Tersedia</h3>
                <p>Mohon maaf, informasi standar layanan sedang dalam pengembangan.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
