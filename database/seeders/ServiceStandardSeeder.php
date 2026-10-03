<?php

namespace Database\Seeders;

use App\Models\ServiceStandard;
use Illuminate\Database\Seeder;

class ServiceStandardSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'nama' => 'Pelayanan Pendaftaran',
                'slug' => 'pelayanan-pendaftaran',
                'deskripsi' => 'Layanan pendaftaran pasien baru dan lama untuk mendapatkan pelayanan kesehatan di Puskesmas.',
                'konten' => "Pelayanan Pendaftaran\n\n" .
                    "A. Persyaratan:\n" .
                    "- Kartu Identitas (KTP/SIM)\n" .
                    "- Kartu BPJS Kesehatan (jika ada)\n" .
                    "- Kartu Keluarga (KK)\n" .
                    "- Surat rujukan dari faskes tingkat pertama (untuk kasus rujukan)\n\n" .
                    "B. Prosedur:\n" .
                    "1. Datang ke loket pendaftaran\n" .
                    "2. Melakukan verifikasi data kepesertaan BPJS\n" .
                    "3. Mendapatkan nomor antrian\n" .
                    "4. Menunggu panggilan sesuai nomor antrian\n\n" .
                    "C. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 07.30 - 12.00 WIB\n" .
                    "Sabtu: 07.30 - 11.00 WIB",
                'icon' => 'fa-calendar-check',
                'urutan' => 1,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Pemeriksaan Umum',
                'slug' => 'pelayanan-pemeriksaan-umum',
                'deskripsi' => 'Layanan pemeriksaan kesehatan umum untuk pasien dengan keluhan penyakit umum.',
                'konten' => "Pelayanan Pemeriksaan Umum\n\n" .
                    "A. Persyaratan:\n" .
                    "- Membawa kartu identitas\n" .
                    "- Membawa kartu BPJS (jika peserta BPJS)\n" .
                    "- Surat rujukan dari dokter keluarga (untuk pasien BPJS)\n\n" .
                    "B. Prosedur:\n" .
                    "1. Daftar di loket pendaftaran\n" .
                    "2. Tunggu panggilan di ruang tunggu\n" .
                    "3. Pemeriksaan oleh dokter umum\n" .
                    "4. Mendapatkan resep atau rujukan jika diperlukan\n\n" .
                    "C. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 08.00 - 12.00 WIB\n" .
                    "D. Dokter yang Bertugas:\n" .
                    "- dr. Pertama\n" .
                    "- dr. Kedua",
                'icon' => 'fa-stethoscope',
                'urutan' => 2,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Tindakan Umum',
                'slug' => 'pelayanan-tindakan-umum',
                'deskripsi' => 'Layanan tindakan medis umum seperti infus, suntik, perawatan luka, dan tindakan medis ringan lainnya.',
                'konten' => "Pelayanan Tindakan Umum\n\n" .
                    "A. Jenis Tindakan:\n" .
                    "- Infus / Terapi cairan\n" .
                    "- Suntik (intravena, intramuskular)\n" .
                    "- Perawatan luka\n" .
                    "- Pengambilan sample laboratorium\n" .
                    "- Nebulizer\n\n" .
                    "B. Prosedur:\n" .
                    "1. Melengkapi surat orders dari dokter\n" .
                    "2. Pendaftaran di loket tindakan\n" .
                    "3. Pelaksanaan tindakan oleh tenaga medis\n" .
                    "4. Monitoring kondisi pasien\n\n" .
                    "C. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 08.00 - 12.00 WIB\n" .
                    "Sabtu: 08.00 - 11.00 WIB",
                'icon' => 'fa-user-md',
                'urutan' => 3,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Kesehatan Ibu dan Anak (KIA)',
                'slug' => 'pelayanan-kia',
                'deskripsi' => 'Layanan kesehatan komprehensif untuk ibu hamil, ibu bersalin, dan anak-anak.',
                'konten' => "Pelayanan Kesehatan Ibu dan Anak (KIA)\n\n" .
                    "A. Layanan yang Disediakan:\n" .
                    "- Pemeriksaan kehamilan (ANC)\n" .
                    "- Persalinan normal\n" .
                    "- Perawatan nifas\n" .
                    "- Kontrasepsi / KB\n" .
                    "- Pemeriksaan bayi dan balita\n" .
                    "- Imunisasi anak\n" .
                    "- Tumbuh kembang anak\n\n" .
                    "B. Prosedur:\n" .
                    "1. Daftar di loket KIA\n" .
                    "2. Pemeriksaan oleh bidan/nakes\n" .
                    "3. Konseling kesehatan ibu dan anak\n" .
                    "4. Rujukan jika diperlukan\n\n" .
                    "C. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 08.00 - 12.00 WIB\n" .
                    "D. Bidan yang Bertugas:\n" .
                    "- Nm. Bidan 1, AMd. Keb\n" .
                    "- Nm. Bidan 2, AMd. Keb",
                'icon' => 'fa-baby',
                'urutan' => 4,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Imunisasi',
                'slug' => 'pelayanan-imunisasi',
                'deskripsi' => 'Layanan imunisasi untuk bayi, anak, dan dewasa sesuai jadwal imunisasi nasional.',
                'konten' => "Pelayanan Imunisasi\n\n" .
                    "A. Jenis Imunisasi:\n" .
                    "1. Imunisasi Dasar untuk Bayi:\n" .
                    "- Hepatitis B\n" .
                    "- BCG\n" .
                    "- Polio\n" .
                    "- DPT-HB-Hib\n" .
                    "- Campak/MR\n\n" .
                    "2. Imunisasi Lanjutan:\n" .
                    "- BIAS (Bulan Imunisasi Anak Sekolah)\n" .
                    "- Imunisasi TT untuk ibu hamil\n" .
                    "- Imunisasi lainnya sesuai kebutuhan\n\n" .
                    "B. Prosedur:\n" .
                    "1. Membawa KMS / buku kesehatan anak\n" .
                    "2. Verifikasi status imunisasi\n" .
                    "3. Penyuntikan imunisasi\n" .
                    "4. Observasi 30 menit setelah imunisasi\n\n" .
                    "C. Waktu Pelayanan:\n" .
                    "Setiap hari kerja sesuai jadwal BIAS",
                'icon' => 'fa-syringe',
                'urutan' => 5,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Gigi dan Mulut',
                'slug' => 'pelayanan-gigi',
                'deskripsi' => 'Layanan kesehatan gigi dan mulut meliputi pemeriksaan, perawatan, dan pencabutan gigi.',
                'konten' => "Pelayanan Gigi dan Mulut\n\n" .
                    "A. Layanan yang Disediakan:\n" .
                    "- Pemeriksaan gigi dan mulut\n" .
                    "- Penambalan gigi\n" .
                    "- Pencabutan gigi (ekstraksi)\n" .
                    "- Scaling (pembersihan karang gigi)\n" .
                    "- Perawatan saluran akar\n" .
                    "- Health education gigi\n\n" .
                    "B. Prosedur:\n" .
                    "1. Daftar di loket pendaftaran\n" .
                    "2. Pemeriksaan oleh dokter gigi\n" .
                    "3. Tindakan medis sesuai diagnose\n" .
                    "4. Edukasi kesehatan gigi\n\n" .
                    "C. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 08.00 - 12.00 WIB\n" .
                    "D. Dokter Gigi:\n" .
                    "- drg. Nama Dokter Gigi",
                'icon' => 'fa-tooth',
                'urutan' => 6,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Laboratorium',
                'slug' => 'pelayanan-laboratorium',
                'deskripsi' => 'Layanan pemeriksaan laboratorium untuk mendukung diagnose penyakit.',
                'konten' => "Pelayanan Laboratorium\n\n" .
                    "A. Jenis Pemeriksaan:\n" .
                    "1. Hematologi:\n" .
                    "- Darah lengkap (Hb, Leukosit, Trombosit)\n" .
                    "- Golongan darah\n" .
                    "- LED\n\n" .
                    "2. Kimia Klinik:\n" .
                    "- Gula darah\n" .
                    "- Kolesterol\n" .
                    "- Asam urat\n" .
                    "- Fungsi liver (SGOT, SGPT)\n" .
                    "- Fungsi ginjal (Ureum, Kreatinin)\n\n" .
                    "3. Urinalisa:\n" .
                    "- Protein, Glukosa, Bilirubin\n" .
                    "- Sedimen urine\n\n" .
                    "B. Prosedur:\n" .
                    "1. Surat orders dari dokter\n" .
                    "2. Pendaftaran dan pembayaran\n" .
                    "3. Pengambilan sample (darah/urine)\n" .
                    "4. Proses pemeriksaan\n" .
                    "5. Pengambilan hasil\n\n" .
                    "C. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 08.00 - 11.00 WIB",
                'icon' => 'fa-vial',
                'urutan' => 7,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Kasir',
                'slug' => 'pelayanan-kasir',
                'deskripsi' => 'Layanan pembayaran dan administrasi keuangan untuk pasien umum dan pasien BPJS.',
                'konten' => "Pelayanan Kasir\n\n" .
                    "A. Jenis Pembayaran:\n" .
                    "- Tunai\n" .
                    "- Debit / Kartu ATM\n" .
                    "- QRIS\n\n" .
                    "B. Layanan:\n" .
                    "- Pembayaran pasien umum\n" .
                    "- Verifikasi biaya tindakan\n" .
                    "- Pencetakan kwitansi\n" .
                    "- Klaim obat keluar\n\n" .
                    "C. Prosedur:\n" .
                    "1. Ambil nomor antrian kasir\n" .
                    "2. Tunggu dipanggil\n" .
                    "3. Lakukan pembayaran\n" .
                    "4. Simpan bukti pembayaran\n\n" .
                    "D. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 08.00 - 12.00 WIB\n" .
                    "Sabtu: 08.00 - 11.00 WIB",
                'icon' => 'fa-cash-register',
                'urutan' => 8,
                'status' => true,
            ],
            [
                'nama' => 'Pelayanan Obat dan Kefarmasian',
                'slug' => 'pelayanan-farmasi',
                'deskripsi' => 'Layanan farmasi meliputi dispensing obat, konsultasi obat, dan edukasi penggunaan obat.',
                'konten' => "Pelayanan Obat dan Kefarmasian\n\n" .
                    "A. Layanan yang Disediakan:\n" .
                    "- Penyerahan obat sesuai resep dokter\n" .
                    "- Konseling obat\n" .
                    "- Edukasi penggunaan obat\n" .
                    "- Informasi obat\n" .
                    "- Monitoring penggunaan obat\n\n" .
                    "B. Prosedur:\n" .
                    "1. Serahkan resep ke loket farmasi\n" .
                    "2. Tunggu proses peracikan/penyiapan obat\n" .
                    "3. Penerimaan obat dan konsultasi (jika diperlukan)\n" .
                    "4. Informasi cara penggunaan obat\n\n" .
                    "C. Kebijakan Obat:\n" .
                    "- Obat generik menjadi pilihan utama\n" .
                    "- Obat keras hanya dengan resep dokter\n" .
                    "- Obat bebas terbatas dengan pembatasan\n\n" .
                    "D. Waktu Pelayanan:\n" .
                    "Senin - Jumat: 08.00 - 12.00 WIB",
                'icon' => 'fa-pills',
                'urutan' => 9,
                'status' => true,
            ],
        ];

        foreach ($services as $service) {
            ServiceStandard::create($service);
        }
    }
}
