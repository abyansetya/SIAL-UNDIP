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
        Schema::create('irs_jadwal', function (Blueprint $table) {
            $table->id(); // Kolom IRS Jadwal ID
            $table->foreignId('irs_id')->constrained('irs')->onDelete('cascade'); // Relasi ke tabel IRS
            $table->foreignId('jadwal_id')->constrained('jadwal_kuliah')->onDelete('cascade'); // Relasi ke tabel jadwal kuliah
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs_jadwal');
    }
};
