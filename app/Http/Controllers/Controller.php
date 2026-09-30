<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    // Menampilkan Halaman Admin
    public function index()
    {
        return view('admin.dashboard');
    }

    // Contoh Method untuk Menyimpan Carousel
    public function storeCarousel(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Simpan gambar ke folder storage/app/public/carousel
            $path = $request->file('image')->store('carousel', 'public');

            // Simpan info ke database (misal via Model Carousel)
            // Carousel::create(['title' => $request->title, 'image' => $path]);
        }

        return redirect()->back()->with('success', 'Gambar Carousel Berhasil Diunggah!');
    }
}