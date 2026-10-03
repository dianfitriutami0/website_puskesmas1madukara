<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\OrganizationStructure;
use App\Models\ServiceType;
use App\Models\ServiceCharter;
use App\Models\ServiceQuality;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function profile()
    {
        $profile = Profile::first();
        return view('public.pages.profile', compact('profile'));
    }

    public function visionMission()
    {
        $profile = Profile::first();
        return view('public.pages.vision-mission', compact('profile'));
    }

    public function organizationStructure()
    {
        $structure = OrganizationStructure::first();
        return view('public.pages.organization-structure', compact('structure'));
    }

    public function serviceTypes()
    {
        $services = ServiceType::where('status', true)->orderBy('urutan')->get();
        return view('public.pages.service-types', compact('services'));
    }

    public function serviceTypeDetail($slug)
    {
        $service = ServiceType::where('slug', $slug)->firstOrFail();
        return view('public.pages.service-type-detail', compact('service'));
    }

    public function serviceCharter()
    {
        $charter = ServiceCharter::first();
        return view('public.pages.service-charter', compact('charter'));
    }

    public function serviceQuality()
    {
        $quality = ServiceQuality::first();
        return view('public.pages.service-quality', compact('quality'));
    }
}
