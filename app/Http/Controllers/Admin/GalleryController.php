<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index', ['photos' => Gallery::latest()->paginate(12)]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => ['nullable', 'string', 'max:150'],
            'photos'   => ['required', 'array', 'max:10'],
            'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        foreach ($request->file('photos') as $photo) {
            Gallery::create([
                'title' => $data['title'] ?? null,
                'image' => $photo->store('gallery', 'public'),
            ]);
        }

        return back()->with('success', 'Foto berhasil diunggah.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return back()->with('success', 'Foto dihapus.');
    }
}