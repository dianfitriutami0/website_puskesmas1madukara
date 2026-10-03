<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_standards', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama layanan
            $table->string('slug')->unique(); // URL slug
            $table->text('deskripsi')->nullable(); // Deskripsi singkat
            $table->longText('konten')->nullable(); // Konten lengkap
            $table->string('icon')->nullable(); // Font Awesome icon
            $table->integer('urutan')->default(0); // Urutan tampil
            $table->boolean('status')->default(true); // Aktif/nonaktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_standards');
    }
};
