<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    public function edit()
    {
        $sambutan = Welcome::first() ?? new Welcome(['jabatan' => 'Kepala Puskesmas']);

        return view('admin.sambutan.edit', compact('sambutan'));
    }

    public function update(Request $request)
    {
        $sambutan = Welcome::first() ?? new Welcome();

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'gelar'        => ['nullable', 'string', 'max:100'],
            'jabatan'      => ['required', 'string', 'max:100'],
            'sambutan'     => ['required', 'string'],
            'foto'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            if ($sambutan->foto) {
                Storage::disk('public')->delete($sambutan->foto);
            }
            $data['foto'] = $request->file('foto')->store('sambutan', 'public');
        } else {
            unset($data['foto']);
        }

        $sambutan->fill($data)->save();

        return back()->with('success', 'Sambutan Kepala Puskesmas berhasil diperbarui.');
    }
}