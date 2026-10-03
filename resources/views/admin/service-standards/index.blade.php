@extends('layouts.admin')

@section('title', 'Standar Layanan')
@section('heading', 'Standar Layanan')
@section('breadcrumb', 'Standar Layanan')

@section('content')
{{-- Info Card --}}
<div class="card" style="margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; background: var(--mint); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-list-check" style="font-size: 20px; color: var(--primary-color);"></i>
        </div>
        <div>
            <p style="font-size: 14px; color: var(--muted); margin-bottom: 2px;">Kelola Standar Layanan</p>
            <p style="font-size: 13px; color: var(--ink);">9 standar layanan yang ditampilkan di halaman publik website.</p>
        </div>
    </div>
</div>

{{-- Actions --}}
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 12px;">
        <a href="{{ route('admin.service-standards.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Tambah Standar Layanan
        </a>
        @if($services->total() > 0)
            <span style="font-size: 13px; color: var(--muted);">
                Total: {{ $services->total() }} layanan
            </span>
        @endif
    </div>
</div>

{{-- Services List --}}
@if($services->isEmpty())
    <div class="empty-state">
        <i class="fa-solid fa-clipboard-list" style="font-size: 48px; color: var(--muted); margin-bottom: 16px;"></i>
        <h3 style="font-size: 18px; color: var(--ink); margin-bottom: 8px;">Belum Ada Standar Layanan</h3>
        <p style="font-size: 14px; color: var(--muted); margin-bottom: 20px;">Klik tombol di atas untuk menambahkan standar layanan.</p>
        <a href="{{ route('admin.service-standards.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Tambah Standar Layanan
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
            <tbody id="sortable-list">
                @foreach($services as $index => $service)
                    <tr data-id="{{ $service->id }}" style="cursor: move;">
                        <td style="text-align: center; color: var(--muted); font-weight: 600;">
                            <i class="fa-solid fa-grip-vertical" style="color: var(--muted); cursor: grab;"></i>
                        </td>
                        <td style="text-align: center;">
                            <div style="width: 44px; height: 44px; background: var(--mint); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fa-solid {{ $service->icon ?? 'fa-circle' }}" style="color: var(--primary-color); font-size: 18px;"></i>
                            </div>
                        </td>
                        <td>
                            <p style="font-weight: 600; color: var(--ink); margin-bottom: 4px;">{{ $service->nama }}</p>
                            <p style="font-size: 11px; color: var(--muted);">
                                <i class="fa-solid fa-link" style="margin-right: 4px;"></i>
                                /standar-layanan/{{ $service->slug }}
                            </p>
                        </td>
                        <td>
                            <span style="font-size: 13px; color: var(--muted);">
                                {{ Str::limit($service->deskripsi, 80) ?? '-' }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <form action="{{ route('admin.service-standards.toggle-status', $service) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="badge {{ $service->status ? 'badge-primary' : 'badge-warning' }}" style="border: none; cursor: pointer;">
                                    <i class="fa-solid {{ $service->status ? 'fa-check' : 'fa-clock' }}" style="margin-right: 4px;"></i>
                                    {{ $service->status ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.service-standards.edit', $service) }}" class="action-link action-edit">
                                <i class="fa-solid fa-pen"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.service-standards.destroy', $service) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Hapus standar layanan ini?')">
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

<style>
    #sortable-list tr:hover {
        background: var(--mint) !important;
    }
    #sortable-list tr.ui-sortable-helper {
        display: table;
        width: 100%;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    #sortable-list tr.ui-sortable-placeholder {
        background: var(--accent-color);
        opacity: 0.2;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const list = document.getElementById('sortable-list');
        if (list && typeof Sortable !== 'undefined') {
            new Sortable(list, {
                handle: 'tr',
                animation: 150,
                ghostClass: 'ui-sortable-helper',
                placeholder: 'ui-sortable-placeholder',
                onEnd: function(evt) {
                    const order = [];
                    list.querySelectorAll('tr').forEach((row, index) => {
                        order.push(row.dataset.id);
                    });
                    fetch('{{ route('admin.service-standards.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    });
                }
            });
        }
    });
</script>
@endpush
