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
        Schema::create('khs', function (Blueprint $table) {
            $table->id(); // ID KHS
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (mahasiswa)
            $table->foreignId('jadwal_id')->constrained('jadwal_kuliah')->onDelete('cascade'); // Relasi ke tabel jadwal_kuliah
            $table->integer('semester'); // Semester mata kuliah diambil
            $table->string('nilai'); // Nilai yang didapat (misal A, B, C, D, E)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};
