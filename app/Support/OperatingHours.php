<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class OperatingHours
{
    public static function defaults(): array
    {
        return [
            ['nama' => 'Poli Umum',   'hari' => 'Senin - Kamis',    'jam' => '08.00 - 14.00 WIB', 'keterangan' => 'Jumat 08.00 - 11.00, Sabtu 08.00 - 12.00'],
            ['nama' => 'Poli Gigi',   'hari' => 'Senin - Sabtu',    'jam' => '08.00 - 13.00 WIB', 'keterangan' => ''],
            ['nama' => 'Poli KIA/KB', 'hari' => 'Senin - Sabtu',    'jam' => '08.00 - 13.00 WIB', 'keterangan' => ''],
            ['nama' => 'UGD',         'hari' => 'Setiap Hari',      'jam' => '24 Jam',            'keterangan' => 'Layanan gawat darurat'],
        ];
    }

    public static function all(): array
    {
        $path = config('puskesmas.operating_hours_path');

        if (! File::exists($path)) {
            return self::defaults();
        }

        $data = json_decode(File::get($path), true);
        $services = $data['services'] ?? null;

        return (is_array($services) && count($services) === 4) ? array_values($services) : self::defaults();
    }

    public static function save(array $services): void
    {
        $path = config('puskesmas.operating_hours_path');
        File::ensureDirectoryExists(dirname($path));

        $clean = collect($services)->take(4)->map(fn ($s) => [
            'nama'       => trim($s['nama'] ?? ''),
            'hari'       => trim($s['hari'] ?? ''),
            'jam'        => trim($s['jam'] ?? ''),
            'keterangan' => trim($s['keterangan'] ?? ''),
        ])->values()->all();

        File::put(
            $path,
            json_encode(['services' => $clean], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            true // LOCK_EX
        );
    }
}