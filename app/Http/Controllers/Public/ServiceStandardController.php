<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ServiceStandard;
use Illuminate\Http\Request;

class ServiceStandardController extends Controller
{
    public function index()
    {
        $services = ServiceStandard::aktif()->get();
        return view('service-standards.index', compact('services'));
    }

    public function show($slug)
    {
        $service = ServiceStandard::where('slug', $slug)->aktif()->firstOrFail();
        $otherServices = ServiceStandard::aktif()->where('id', '!=', $service->id)->take(4)->get();

        return view('service-standards.show', compact('service', 'otherServices'));
    }
}
