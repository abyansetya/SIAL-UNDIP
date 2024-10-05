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
        Schema::create('irs', function (Blueprint $table) {
            $table->id(); // Kolom IRS ID
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (mahasiswa)
            $table->integer('semester'); // Semester IRS
            $table->string('status')->default('pending'); // Status IRS (pending, disetujui, atau ditolak)
            $table->timestamps(); // Timestamps created_at dan updated_at

            // Kombinasi unique user_id dan semester untuk memastikan satu IRS per semester
            $table->unique(['user_id', 'semester']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs');
    }
};
