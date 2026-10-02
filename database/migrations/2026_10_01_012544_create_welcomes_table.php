<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('welcomes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('gelar')->nullable();
            $table->string('jabatan')->default('Kepala Puskesmas');
            $table->string('foto')->nullable();
            $table->longText('sambutan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('welcomes');
    }
};