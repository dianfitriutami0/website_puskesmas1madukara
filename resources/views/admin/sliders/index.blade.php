@extends('layouts.admin')

@section('title', 'Slider Utama')
@section('heading', 'Slider Utama')
@section('breadcrumb', 'Slider')

@section('content')
<div class="card" style="margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; background: var(--mint); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-info-circle" style="font-size: 20px; color: var(--primary-color);"></i>
        </div>
        <div>
            <p style="font-size: 14px; color: var(--muted); margin-bottom: 2px;">Informasi Penting</p>
            <p style="font-size: 13px; color: var(--ink);">Format JPG/PNG/WebP, maksimal 3 MB. Disarankan rasio 1600x600.</p>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
    @foreach ([1, 2, 3, 4] as $pos)
        @php $slide = $sliders->get($pos); @endphp
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                <h3 style="font-size: 16px; font-weight: 700; color: var(--ink);">
                    <i class="fa-solid fa-image" style="color: var(--primary-color); margin-right: 8px;"></i>
                    Slot {{ $pos }}
                </h3>
                @if ($slide)
                    <span class="badge badge-primary">
                        <i class="fa-solid fa-check"></i>
                        Aktif
                    </span>
                @endif
            </div>

            @if ($slide)
                <div style="margin-bottom: 16px; border-radius: var(--radius-sm); overflow: hidden; height: 160px;">
                    <img src="{{ asset('storage/' . $slide->image) }}" alt="Slide {{ $pos }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @if ($slide->title)
                    <p style="font-size: 13px; color: var(--ink); margin-bottom: 12px; font-weight: 500;">
                        <i class="fa-solid fa-tag" style="color: var(--muted); margin-right: 4px;"></i>
                        {{ $slide->title }}
                    </p>
                @endif
            @else
                <div style="margin-bottom: 16px; height: 160px; background: var(--bg-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; border: 2px dashed var(--line);">
                    <div style="text-align: center; color: var(--muted);">
                        <i class="fa-solid fa-image" style="font-size: 32px; margin-bottom: 8px; opacity: 0.5;"></i>
                        <p style="font-size: 13px;">Belum ada gambar</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.sliders.upsert', $pos) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Judul / Caption (opsional)</label>
                    <input type="text" name="title" value="{{ $slide->title ?? '' }}"
                           placeholder="Masukkan caption untuk slide..."
                           class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Gambar Slide</label>
                    <input type="file" name="image" accept="image/*" {{ $slide ? '' : 'required' }}
                           class="form-input" style="padding: 10px;">
                    <p class="form-hint">JPG/PNG/WebP, maks 3 MB</p>
                </div>
                <div style="display: flex; gap: 8px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">
                        <i class="fa-solid {{ $slide ? 'fa-floppy-disk' : 'fa-upload' }}"></i>
                        {{ $slide ? 'Ganti Gambar' : 'Unggah' }}
                    </button>
                    @if ($slide)
                        <form method="POST" action="{{ route('admin.sliders.destroy', $pos) }}" style="display: inline;"
                              onsubmit="return confirm('Hapus slide ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection
