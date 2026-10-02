<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(9);

        return view('berita.index', compact('news'));
    }

    public function show(News $news)
    {
        $others = News::where('id', '!=', $news->id)->latest()->take(3)->get();

        return view('berita.show', compact('news', 'others'));
    }
}