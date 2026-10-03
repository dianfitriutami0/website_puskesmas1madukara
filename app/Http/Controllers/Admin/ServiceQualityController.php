<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceQuality;
use Illuminate\Http\Request;

class ServiceQualityController extends Controller
{
    public function edit()
    {
        $quality = ServiceQuality::first() ?? ServiceQuality::create([
            'title' => 'Mutu Pelayanan'
        ]);
        return view('admin.service-qualities.edit', compact('quality'));
    }

    public function update(Request $request, ServiceQuality $quality)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'konten' => 'nullable|string',
        ]);

        $quality->update($request->all());

        return redirect()
            ->route('admin.service-qualities.edit')
            ->with('success', 'Mutu pelayanan berhasil diperbarui.');
    }
}
