<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first() ?? Profile::create([]);
        return view('admin.profiles.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'konten' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tata_nilai' => 'nullable|string',
        ]);

        $profile->update($request->all());

        return redirect()
            ->route('admin.profiles.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
