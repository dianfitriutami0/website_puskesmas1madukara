<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceStandardController extends Controller
{
    public function index()
    {
        $services = ServiceStandard::orderBy('urutan')->orderBy('id')->paginate(10);
        return view('admin.service-standards.index', compact('services'));
    }

    public function create()
    {
        return view('admin.service-standards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_standards,slug',
            'deskripsi' => 'nullable|string',
            'konten' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ?: Str::slug($request->nama);

        ServiceStandard::create($data);

        return redirect()
            ->route('admin.service-standards.index')
            ->with('success', 'Standar layanan berhasil ditambahkan.');
    }

    public function edit(ServiceStandard $serviceStandard)
    {
        return view('admin.service-standards.edit', compact('serviceStandard'));
    }

    public function update(Request $request, ServiceStandard $serviceStandard)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_standards,slug,' . $serviceStandard->id,
            'deskripsi' => 'nullable|string',
            'konten' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->all();
        if (empty($request->slug)) {
            $data['slug'] = Str::slug($request->nama);
        }

        $serviceStandard->update($data);

        return redirect()
            ->route('admin.service-standards.index')
            ->with('success', 'Standar layanan berhasil diperbarui.');
    }

    public function destroy(ServiceStandard $serviceStandard)
    {
        $serviceStandard->delete();

        return redirect()
            ->route('admin.service-standards.index')
            ->with('success', 'Standar layanan berhasil dihapus.');
    }

    public function toggleStatus(ServiceStandard $serviceStandard)
    {
        $serviceStandard->update(['status' => !$serviceStandard->status]);

        return redirect()
            ->route('admin.service-standards.index')
            ->with('success', 'Status standar layanan berhasil diubah.');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            ServiceStandard::where('id', $id)->update(['urutan' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
