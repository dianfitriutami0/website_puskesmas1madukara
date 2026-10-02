<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;
use App\Models\Slider;
use App\Models\Welcome;
use App\Support\OperatingHours;

class HomeController extends Controller
{
    public function index()
    {
        $sliders  = Slider::orderBy('position')->take(4)->get();
        $sambutan = Welcome::first();
        $services = OperatingHours::all();
        $latestNews = News::latest()->take(6)->get();

        // Galeri gabungan: foto utama berita + foto dari menu Galeri admin
        $newsPhotos = News::whereNotNull('image')->get()->map(fn ($n) => (object) [
            'title'      => $n->title,
            'image'      => $n->image,
            'source'     => 'Berita',
            'created_at' => $n->created_at,
        ]);

        $galleryPhotos = Gallery::all()->map(fn ($g) => (object) [
            'title'      => $g->title,
            'image'      => $g->image,
            'source'     => 'Galeri',
            'created_at' => $g->created_at,
        ]);

        $photos = $newsPhotos->concat($galleryPhotos)
            ->sortByDesc(fn ($p) => $p->created_at->timestamp)
            ->values()
            ->take(12);

        return view('welcome', compact('sliders', 'sambutan', 'services', 'latestNews', 'photos'));
    }
}