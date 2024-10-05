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
        Schema::create('ruang_kelas_program_studi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruang_kelas_id')->constrained('ruang_kelas')->onDelete('cascade'); // Relasi ke tabel ruang_kelas
            $table->foreignId('program_studi_id')->constrained('program_studi')->onDelete('cascade'); // Relasi ke tabel program_studi
            $table->integer('kuota'); // Kuota untuk kombinasi ruang kelas dan program studi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang_kelas_program_studi');
    }
};
