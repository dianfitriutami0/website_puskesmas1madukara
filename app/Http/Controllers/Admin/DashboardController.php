<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Slider;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'sliderCount'  => Slider::count(),
            'newsCount'    => News::count(),
            'galleryCount' => Gallery::count(),
        ]);
    }
}