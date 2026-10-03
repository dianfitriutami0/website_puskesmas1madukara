<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCharter;
use Illuminate\Http\Request;

class ServiceCharterController extends Controller
{
    public function edit()
    {
        $charter = ServiceCharter::first() ?? ServiceCharter::create([
            'title' => 'Maklumat Layanan'
        ]);
        return view('admin.service-charters.edit', compact('charter'));
    }

    public function update(Request $request, ServiceCharter $charter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'konten' => 'nullable|string',
        ]);

        $charter->update($request->all());

        return redirect()
            ->route('admin.service-charters.edit')
            ->with('success', 'Maklumat layanan berhasil diperbarui.');
    }
}
