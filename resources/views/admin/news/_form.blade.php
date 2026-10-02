<form method="POST" action="{{ $action }}" enctype="multipart/form-data"
      class="max-w-3xl space-y-5 rounded-xl bg-white p-6 shadow-sm">
    @csrf
    @if ($method !== 'POST') @method($method) @endif

    <div>
        <label class="mb-1 block text-sm font-medium">Judul</label>
        <input type="text" name="title" value="{{ old('title', $news->title) }}" required
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $news->slug) }}" placeholder="dibuat otomatis dari judul jika kosong"
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Foto Utama</label>
        @if ($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" alt="" class="mb-3 h-36 rounded-lg object-cover">
        @endif
        <input type="file" name="image" accept="image/*" {{ $news->exists ? '' : 'required' }}
               class="block w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-2 file:text-emerald-700">
        <p class="mt-1 text-xs text-slate-400">JPG/PNG/WebP, maks 3 MB.</p>
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Konten</label>
        <textarea name="content" rows="12" required
                  class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('content', $news->content) }}</textarea>
    </div>

    <div class="flex gap-3">
        <button class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white hover:bg-emerald-700">Simpan</button>
        <a href="{{ route('admin.news.index') }}" class="rounded-lg px-5 py-2 text-slate-600 hover:bg-slate-100">Batal</a>
    </div>
</form>