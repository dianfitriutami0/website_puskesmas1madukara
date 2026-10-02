<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news.index', ['news' => News::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, new News());
        $data['image'] = $request->file('image')->store('news', 'public');

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dipublikasikan.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $this->validated($request, $news);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return back()->with('success', 'Berita dihapus.');
    }

    private function validated(Request $request, News $news): array
    {
        $data = $request->validate([
            'title'   => ['required', 'string', 'max:200'],
            'slug'    => ['nullable', 'alpha_dash', 'max:220', Rule::unique('news', 'slug')->ignore($news->id)],
            'content' => ['required', 'string'],
            'image'   => [$news->exists ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        unset($data['image']);
        $data['slug'] = $this->uniqueSlug(Str::slug($data['slug'] ?: $data['title']), $news->id);

        return $data;
    }

    private function uniqueSlug(string $slug, ?int $ignoreId): string
    {
        $candidate = $slug;
        $i = 2;

        while (News::where('slug', $candidate)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $candidate = $slug . '-' . $i++;
        }

        return $candidate;
    }
}