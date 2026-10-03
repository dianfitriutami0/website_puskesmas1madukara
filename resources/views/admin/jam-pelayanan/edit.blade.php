@extends('layouts.admin')

@section('title', 'Jam Pelayanan')
@section('heading', 'Jam Pelayanan')
@section('breadcrumb', 'Jam Layanan')

@php
    $serviceIcons = [
        'fa-stethoscope',
        'fa-tooth',
        'fa-baby',
        'fa-truck-medical'
    ];
@endphp

@section('content')
<div class="card" style="margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; background: var(--mint); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-info-circle" style="font-size: 20px; color: var(--primary-color);"></i>
        </div>
        <div>
            <p style="font-size: 14px; color: var(--muted); margin-bottom: 2px;">Informasi</p>
            <p style="font-size: 13px; color: var(--ink);">
                Data disimpan ke file <code style="background: var(--bg-light); padding: 2px 6px; border-radius: 4px;">storage/app/operating_hours.json</code>, bukan database.
            </p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.hours.update') }}">
    @csrf @method('PUT')

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 24px; margin-bottom: 32px;">
        @foreach ($services as $i => $s)
            <div class="card">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--line);">
                    <div style="width: 48px; height: 48px; background: var(--mint); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid {{ $serviceIcons[$i] ?? 'fa-notes-medical' }}" style="font-size: 20px; color: var(--primary-color);"></i>
                    </div>
                    <div>
                        <p style="font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px;">Kotak {{ $i + 1 }}</p>
                        <p style="font-size: 14px; font-weight: 600; color: var(--ink);">{{ $s['nama'] ?? 'Pelayanan' }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Pelayanan</label>
                    <input type="text" name="services[{{ $i }}][nama]"
                           value="{{ old("services.$i.nama", $s['nama']) }}" required
                           placeholder="Contoh: Instalasi Gawat Darurat"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Hari</label>
                    <input type="text" name="services[{{ $i }}][hari]"
                           value="{{ old("services.$i.hari", $s['hari']) }}" required
                           placeholder="Contoh: Senin - Jumat"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Jam</label>
                    <input type="text" name="services[{{ $i }}][jam]"
                           value="{{ old("services.$i.jam", $s['jam']) }}" required
                           placeholder="Contoh: 07.30 - 12.00"
                           class="form-input">
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Keterangan (opsional)</label>
                    <input type="text" name="services[{{ $i }}][keterangan]"
                           value="{{ old("services.$i.keterangan", $s['keterangan']) }}"
                           placeholder="Contoh: 24 Jam pada hari tertentu"
                           class="form-input">
                </div>
            </div>
        @endforeach
    </div>

    <div style="display: flex; gap: 12px;">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i>
            Simpan Jam Pelayanan
        </button>
    </div>
</form>
@endsection
