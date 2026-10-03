@extends('layouts.admin')

@section('title', 'Edit Standar Layanan')
@section('heading', 'Edit Standar Layanan')
@section('breadcrumb', 'Standar Layanan')

@php
$iconOptions = [
    'fa-clipboard-list' => 'Clipboard List',
    'fa-stethoscope' => 'Stethoscope (Pemeriksaan Umum)',
    'fa-user-md' => 'User MD (Tindakan Umum)',
    'fa-baby' => 'Baby (KIA/KB)',
    'fa-syringe' => 'Syringe (Imunisasi)',
    'fa-tooth' => 'Tooth (Gigi)',
    'fa-vial' => 'Vial (Laboratorium)',
    'fa-cash-register' => 'Kasir',
    'fa-pills' => 'Pills (Farmasi)',
    'fa-calendar-check' => 'Calendar (Pendaftaran)',
    'fa-heartbeat' => 'Heartbeat (IGD)',
    'fa-ambulance' => 'Ambulance',
    'fa-user-nurse' => 'Nurse',
    'fa-bed' => 'Bed',
    'fa-notes-medical' => 'Notes Medical',
    'fa-hospital' => 'Hospital',
    'fa-medkit' => 'Medkit',
    'fa-heart' => 'Heart',
    'fa-brain' => 'Brain',
    'fa-eye' => 'Eye',
    'fa-ear' => 'Ear',
    'fa-lungs' => 'Lungs',
    'fa-bone' => 'Bone',
    'fa-hand-holding-medical' => 'Hand Medical',
];
@endphp

@section('content')
<form action="{{ route('admin.service-standards.update', $serviceStandard) }}" method="POST" class="card" style="max-width: 800px;">
    @csrf
    @method('PUT')

    <div class="card-header">
        <h2 class="card-title">
            <i class="fa-solid fa-pen"></i>
            Edit Standar Layanan
        </h2>
        <a href="{{ route('admin.service-standards.index') }}" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-tag" style="margin-right: 6px; color: var(--muted);"></i>
            Nama Layanan <span style="color: var(--danger);">*</span>
        </label>
        <input type="text" name="nama" value="{{ old('nama', $serviceStandard->nama) }}" required
               placeholder="Contoh: Pelayanan Pendaftaran"
               class="form-input">
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-link" style="margin-right: 6px; color: var(--muted);"></i>
            Slug URL
        </label>
        <input type="text" name="slug" value="{{ old('slug', $serviceStandard->slug) }}"
               placeholder="kosongkan untuk generate otomatis"
               class="form-input">
        <p class="form-hint">Slug URL untuk halaman ini.</p>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-icons" style="margin-right: 6px; color: var(--muted);"></i>
            Icon
        </label>
        <div style="display: flex; align-items: center; gap: 12px;">
            <select name="icon" id="icon-select" class="form-input" style="flex: 1;">
                <option value="">-- Pilih Icon --</option>
                @foreach($iconOptions as $icon => $label)
                    <option value="{{ $icon }}" {{ old('icon', $serviceStandard->icon) == $icon ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <div id="icon-preview" style="width: 48px; height: 48px; background: var(--mint); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid {{ $serviceStandard->icon ?? 'fa-circle' }}" style="color: var(--primary-color); font-size: 20px;"></i>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-align-left" style="margin-right: 6px; color: var(--muted);"></i>
            Deskripsi Singkat
        </label>
        <textarea name="deskripsi" rows="3"
                  placeholder="Deskripsi singkat tentang layanan ini..."
                  class="form-input">{{ old('deskripsi', $serviceStandard->deskripsi) }}</textarea>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-file-lines" style="margin-right: 6px; color: var(--muted);"></i>
            Konten Lengkap
        </label>
        <textarea name="konten" rows="10"
                  placeholder="Konten lengkap tentang standar pelayanan ini..."
                  class="form-input">{{ old('konten', $serviceStandard->konten) }}</textarea>
        <p class="form-hint">Jelaskan secara detail standar pelayanan, persyaratan, prosedur, dan waktu pelayanan.</p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div class="form-group">
            <label class="form-label">
                <i class="fa-solid fa-sort-numeric-up" style="margin-right: 6px; color: var(--muted);"></i>
                Urutan Tampil
            </label>
            <input type="number" name="urutan" value="{{ old('urutan', $serviceStandard->urutan) }}" min="0"
                   class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fa-solid fa-toggle-on" style="margin-right: 6px; color: var(--muted);"></i>
                Status
            </label>
            <select name="status" class="form-input">
                <option value="1" {{ old('status', $serviceStandard->status) == '1' || $serviceStandard->status ? 'selected' : '' }}>
                    Aktif - Tampilkan di website
                </option>
                <option value="0" {{ old('status', $serviceStandard->status) == '0' || (!$serviceStandard->status && old('status') !== null) ? 'selected' : '' }}>
                    Nonaktif - Sembunyikan dari website
                </option>
            </select>
        </div>
    </div>

    <div style="display: flex; gap: 12px; padding-top: 8px;">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i>
            Simpan Perubahan
        </button>
        <a href="{{ route('admin.service-standards.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-xmark"></i>
            Batal
        </a>
    </div>
</form>

@push('scripts')
<script>
    document.getElementById('icon-select').addEventListener('change', function() {
        const preview = document.getElementById('icon-preview');
        const icon = this.value || 'fa-circle';
        preview.innerHTML = '<i class="fa-solid ' + icon + '" style="color: var(--primary-color); font-size: 20px;"></i>';
    });
</script>
@endpush
@endsection
