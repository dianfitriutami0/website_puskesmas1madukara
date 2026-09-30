<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\CarouselBanner;
use App\Models\Galeri;
use App\Models\ProfilOrganisasi;
use App\Models\ProfilPimpinan;
use App\Models\StandarPelayanan;
use Illuminate\Support\Facades\Storage;

class DashboardController
{
    // 1. Menampilkan Halaman Dashboard Admin
    public function index()
    {
        return view('admin.dashboard', [
            'carousels'  => CarouselBanner::latest()->get(),
            'pimpinan'   => ProfilPimpinan::first(),
            'berita'     => Berita::latest()->get(),
            'galeri'     => Galeri::latest()->get(),
            'organisasi' => ProfilOrganisasi::all()->keyBy('jenis'),
            'standar'    => StandarPelayanan::all()->keyBy('kategori'),
        ]);
    }

    // 2. Simpan Carousel Banner
    public function storeCarousel(Request $request)
    {
        $request->validate([
            'judul'  => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('gambar')->store('carousels', 'public');

        CarouselBanner::create([
            'judul'  => $request->judul,
            'gambar' => $path,
        ]);

        return back()->with('success', 'Banner Carousel berhasil disimpan!');
    }

    // 3. Simpan / Perbarui Profil Pimpinan
    public function updatePimpinan(Request $request)
    {
        $request->validate([
            'nama_pimpinan' => 'required|string',
            'jabatan'       => 'required|string',
            'kata_sambutan' => 'required|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $pimpinan = ProfilPimpinan::first() ?? new ProfilPimpinan();
        $pimpinan->nama_pimpinan = $request->nama_pimpinan;
        $pimpinan->jabatan       = $request->jabatan;
        $pimpinan->kutipan       = $request->kutipan;
        $pimpinan->kata_sambutan = $request->kata_sambutan;

        if ($request->hasFile('foto')) {
            if ($pimpinan->foto) {
                Storage::disk('public')->delete($pimpinan->foto);
            }
            $pimpinan->foto = $request->file('foto')->store('pimpinan', 'public');
        }

        $pimpinan->save();

        return back()->with('success', 'Data Pimpinan berhasil diperbarui!');
    }

    // 4. Simpan Gambar Profil Organisasi (Visi Misi / Struktur / Motto / Tata Nilai)
    public function storeOrganisasi(Request $request)
    {
        $request->validate([
            'jenis'  => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $existing = ProfilOrganisasi::where('jenis', $request->jenis)->first();
        if ($existing && $existing->gambar) {
            Storage::disk('public')->delete($existing->gambar);
        }

        $path = $request->file('gambar')->store('organisasi', 'public');

        ProfilOrganisasi::updateOrCreate(
            ['jenis' => $request->jenis],
            ['gambar' => $path, 'keterangan' => $request->keterangan]
        );

        return back()->with('success', 'Gambar profil organisasi berhasil diperbarui!');
    }

    // 5. Simpan Standar / Maklumat / Mutu Pelayanan
    public function storeStandarPelayanan(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'gambar'   => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $existing = StandarPelayanan::where('kategori', $request->kategori)->first();
        if ($existing && $existing->gambar) {
            Storage::disk('public')->delete($existing->gambar);
        }

        $path = $request->file('gambar')->store('standar_pelayanan', 'public');

        StandarPelayanan::updateOrCreate(
            ['kategori' => $request->kategori],
            ['gambar' => $path, 'judul' => $request->judul]
        );

        return back()->with('success', 'Dokumen standar pelayanan berhasil disimpan!');
    }
}