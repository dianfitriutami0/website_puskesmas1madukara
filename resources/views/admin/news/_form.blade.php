<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="card" style="border: none; box-shadow: var(--shadow-md);">
    @csrf
    @if ($method !== 'POST') @method($method) @endif

    <div class="card-header">
        <h2 class="card-title">
            <i class="fa-solid {{ $news->exists ? 'fa-pen' : 'fa-plus' }}"></i>
            {{ $news->exists ? 'Edit Berita' : 'Buat Berita Baru' }}
        </h2>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-heading" style="margin-right: 6px; color: var(--muted);"></i>
            Judul Berita
        </label>
        <input type="text" name="title" value="{{ old('title', $news->title) }}" required
               placeholder="Masukkan judul berita..."
               class="form-input">
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-link" style="margin-right: 6px; color: var(--muted);"></i>
            Slug URL
        </label>
        <input type="text" name="slug" value="{{ old('slug', $news->slug) }}"
               placeholder="dibuat otomatis dari judul jika kosong"
               class="form-input">
        <p class="form-hint">Slug adalah URL-friendly version dari judul. Biarkan kosong untuk generates otomatis.</p>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-image" style="margin-right: 6px; color: var(--muted);"></i>
            Foto Utama
        </label>
        @if ($news->image)
            <div style="margin-bottom: 12px; border-radius: var(--radius-sm); overflow: hidden; height: 160px; max-width: 300px;">
                <img src="{{ asset('storage/' . $news->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        @endif
        <input type="file" name="image" accept="image/*" {{ $news->exists ? '' : 'required' }}
               class="form-input" style="padding: 10px;">
        <p class="form-hint">JPG/PNG/WebP, maksimal 3 MB.</p>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fa-solid fa-paragraph" style="margin-right: 6px; color: var(--muted);"></i>
            Konten Berita
        </label>
        <textarea name="content" rows="12" required
                  placeholder="Tuliskan konten berita di sini..."
                  class="form-input">{{ old('content', $news->content) }}</textarea>
    </div>

    <div style="display: flex; gap: 12px; padding-top: 8px;">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk"></i>
            Simpan
        </button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-xmark"></i>
            Batal
        </a>
    </div>
</form>
