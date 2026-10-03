<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $services = ServiceType::orderBy('urutan')->orderBy('id')->paginate(10);
        return view('admin.service-types.index', compact('services'));
    }

    public function create()
    {
        return view('admin.service-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_types,slug',
            'deskripsi' => 'nullable|string',
            'konten' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ?: Str::slug($request->nama);

        ServiceType::create($data);

        return redirect()
            ->route('admin.service-types.index')
            ->with('success', 'Jenis layanan berhasil ditambahkan.');
    }

    public function edit(ServiceType $serviceType)
    {
        return view('admin.service-types.edit', compact('serviceType'));
    }

    public function update(Request $request, ServiceType $serviceType)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_types,slug,' . $serviceType->id,
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

        $serviceType->update($data);

        return redirect()
            ->route('admin.service-types.index')
            ->with('success', 'Jenis layanan berhasil diperbarui.');
    }

    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();

        return redirect()
            ->route('admin.service-types.index')
            ->with('success', 'Jenis layanan berhasil dihapus.');
    }

    public function toggleStatus(ServiceType $serviceType)
    {
        $serviceType->update(['status' => !$serviceType->status]);

        return redirect()
            ->route('admin.service-types.index')
            ->with('success', 'Status jenis layanan berhasil diubah.');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            ServiceType::where('id', $id)->update(['urutan' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
