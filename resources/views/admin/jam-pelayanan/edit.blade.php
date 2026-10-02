@extends('layouts.admin')

@section('title', 'Jam Pelayanan')
@section('heading', 'Jam Pelayanan')

@section('content')
<p class="mb-6 text-sm text-slate-500">
    Data disimpan ke file <code class="rounded bg-slate-200 px-1">storage/app/operating_hours.json</code>, bukan database.
</p>

<form method="POST" action="{{ route('admin.hours.update') }}" class="space-y-6">
    @csrf @method('PUT')

    <div class="grid gap-6 md:grid-cols-2">
        @foreach ($services as $i => $s)
            <fieldset class="space-y-3 rounded-xl bg-white p-5 shadow-sm">
                <legend class="px-1 text-sm font-semibold text-emerald-700">Kotak {{ $i + 1 }}</legend>

                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-500">Nama Pelayanan</label>
                    <input type="text" name="services[{{ $i }}][nama]" value="{{ old("services.$i.nama", $s['nama']) }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-500">Hari</label>
                    <input type="text" name="services[{{ $i }}][hari]" value="{{ old("services.$i.hari", $s['hari']) }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-500">Jam</label>
                    <input type="text" name="services[{{ $i }}][jam]" value="{{ old("services.$i.jam", $s['jam']) }}" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-medium text-slate-500">Keterangan (opsional)</label>
                    <input type="text" name="services[{{ $i }}][keterangan]" value="{{ old("services.$i.keterangan", $s['keterangan']) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                </div>
            </fieldset>
        @endforeach
    </div>

    <button class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white hover:bg-emerald-700">Simpan Jam Pelayanan</button>
</form>
@endsection