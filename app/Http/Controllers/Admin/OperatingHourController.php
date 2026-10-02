<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\OperatingHours;
use Illuminate\Http\Request;

class OperatingHourController extends Controller
{
    public function edit()
    {
        return view('admin.jam-pelayanan.edit', ['services' => OperatingHours::all()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'services'              => ['required', 'array', 'size:4'],
            'services.*.nama'       => ['required', 'string', 'max:60'],
            'services.*.hari'       => ['required', 'string', 'max:80'],
            'services.*.jam'        => ['required', 'string', 'max:80'],
            'services.*.keterangan' => ['nullable', 'string', 'max:150'],
        ]);

        OperatingHours::save($data['services']); // menulis ulang operating_hours.json

        return back()->with('success', 'Jam pelayanan berhasil disimpan.');
    }
}