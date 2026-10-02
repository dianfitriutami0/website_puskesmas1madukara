<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('position')->get()->keyBy('position');

        return view('admin.sliders.index', compact('sliders'));
    }

    /** Simpan/ganti gambar pada slot 1-4. */
    public function upsert(Request $request, int $position)
    {
        $slider = Slider::firstOrNew(['position' => $position]);

        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:120'],
            'image' => [$slider->exists ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $slider->image = $request->file('image')->store('sliders', 'public');
        }

        $slider->title = $data['title'] ?? null;
        $slider->save();

        return back()->with('success', "Slide #{$position} berhasil disimpan.");
    }

    public function destroy(int $position)
    {
        $slider = Slider::where('position', $position)->firstOrFail();
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return back()->with('success', "Slide #{$position} dihapus.");
    }
}