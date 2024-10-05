<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_kuliah', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('cascade'); // Relasi ke tabel mata_kuliah
            $table->foreignId('ruangan_id')->constrained('ruang_kelas')->onDelete('cascade'); // Relasi ke tabel ruangan
            $table->string('kelas'); // Kelas untuk jadwal
            $table->string('hari'); // Hari pelajaran
            $table->time('jam_mulai'); // Jam mulai kuliah
            $table->time('jam_selesai'); // Jam selesai kuliah
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliah');
    }
};
