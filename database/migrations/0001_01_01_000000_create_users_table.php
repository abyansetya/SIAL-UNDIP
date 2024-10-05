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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID user
            $table->string('nama'); // Nama pengguna
            $table->string('email')->unique(); // Email pengguna
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email
            $table->string('password'); // Password
            $table->string('NIM_NIP')->unique(); // Nomor Induk Mahasiswa / Nomor Induk Pegawai
            $table->string('alamat'); // Alamat pengguna
            $table->string('telepon', 15); // Nomor telepon
            $table->string('status'); // Status pengguna (aktif, non-aktif, dll.)
            $table->foreignId('wali_id')->nullable()->constrained('users')->onDelete('set null'); // Relasi ke wali
            $table->rememberToken(); // Token untuk 'remember me'
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
