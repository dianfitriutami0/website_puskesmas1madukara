@extends('layouts.admin')

@section('title', 'Jenis Layanan')
@section('heading', 'Jenis Layanan')
@section('breadcrumb', 'Jenis Layanan')

@section('content')
<div class="card" style="margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; background: var(--mint); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-stethoscope" style="font-size: 20px; color: var(--primary-color);"></i>
        </div>
        <div>
            <p style="font-size: 14px; color: var(--muted); margin-bottom: 2px;">Kelola Jenis Layanan</p>
            <p style="font-size: 13px; color: var(--ink);">Kelola jenis layanan yang ditampilkan di halaman publik website.</p>
        </div>
    </div>
</div>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 12px;">
        <a href="{{ route('admin.service-types.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Tambah Jenis Layanan
        </a>
        @if($services->total() > 0)
            <span style="font-size: 13px; color: var(--muted);">
                Total: {{ $services->total() }} layanan
            </span>
        @endif
    </div>
</div>

@if($services->isEmpty())
    <div class="empty-state">
        <i class="fa-solid fa-stethoscope" style="font-size: 48px; color: var(--muted); margin-bottom: 16px;"></i>
        <h3 style="font-size: 18px; color: var(--ink); margin-bottom: 8px;">Belum Ada Jenis Layanan</h3>
        <p style="font-size: 14px; color: var(--muted); margin-bottom: 20px;">Klik tombol di atas untuk menambahkan jenis layanan.</p>
        <a href="{{ route('admin.service-types.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Tambah Jenis Layanan
        </a>
    </div>
@else
    <div class="card" style="padding: 0; overflow: hidden;">
        <table class="data-table" style="margin: 0;">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th style="width: 80px;">Icon</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th style="width: 100px; text-align: center;">Status</th>
                    <th style="width: 180px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td style="text-align: center; color: var(--muted);">{{ $loop->iteration }}</td>
                        <td style="text-align: center;">
                            <div style="width: 44px; height: 44px; background: var(--mint); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fa-solid {{ $service->icon ?? 'fa-circle' }}" style="color: var(--primary-color); font-size: 18px;"></i>
                            </div>
                        </td>
                        <td>
                            <p style="font-weight: 600; color: var(--ink); margin-bottom: 4px;">{{ $service->nama }}</p>
                            <p style="font-size: 11px; color: var(--muted);">
                                <i class="fa-solid fa-link" style="margin-right: 4px;"></i>
                                /jenis-layanan/{{ $service->slug }}
                            </p>
                        </td>
                        <td>
                            <span style="font-size: 13px; color: var(--muted);">
                                {{ Str::limit($service->deskripsi, 80) ?? '-' }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <form action="{{ route('admin.service-types.toggle-status', $service) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="badge {{ $service->status ? 'badge-primary' : 'badge-warning' }}" style="border: none; cursor: pointer;">
                                    <i class="fa-solid {{ $service->status ? 'fa-check' : 'fa-clock' }}" style="margin-right: 4px;"></i>
                                    {{ $service->status ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.service-types.edit', $service) }}" class="action-link action-edit">
                                <i class="fa-solid fa-pen"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.service-types.destroy', $service) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Hapus jenis layanan ini?')">
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

    @if($services->hasPages())
        <div class="pagination-wrapper">
            {{ $services->links() }}
        </div>
    @endif
@endif
@endsection
