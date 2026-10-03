<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationStructure;
use Illuminate\Http\Request;

class OrganizationStructureController extends Controller
{
    public function index()
    {
        $structure = OrganizationStructure::first() ?? OrganizationStructure::create([
            'title' => 'Struktur Organisasi'
        ]);
        return view('admin.organization-structures.index', compact('structure'));
    }

    public function update(Request $request, OrganizationStructure $structure)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('organization-structures', 'public');
            $data['image'] = $path;
        }

        $structure->update($data);

        return redirect()
            ->route('admin.organization-structures.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }
}
