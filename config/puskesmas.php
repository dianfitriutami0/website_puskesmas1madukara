<?php

return [
    'name' => env('PUSKESMAS_NAME', 'Puskesmas 1 Madukara'),
    'address' => env('PUSKESMAS_ADDRESS', 'Madukara, Kabupaten Banjarnegara, Jawa Tengah'),

    // Ganti dengan URL "Sematkan peta" dari Google Maps lokasi Puskesmas yang tepat.
    'maps_embed_url' => env(
        'PUSKESMAS_MAPS_EMBED_URL',
        'https://www.google.com/maps?q=Puskesmas+1+Madukara+Banjarnegara&output=embed'
    ),

    // Jam pelayanan TIDAK disimpan di database.
    'operating_hours_path' => storage_path('app/operating_hours.json'),
];