<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID unik user
            $table->string('name'); // Nama lengkap pengguna
            $table->string('username')->unique(); // Username unik untuk profil
            $table->string('email')->unique(); // Email login
            $table->string('password'); // Password terenkripsi

            // Profil pengguna
            $table->string('profile_picture')->nullable(); // Foto profil
            $table->text('bio')->nullable(); // Deskripsi singkat
            $table->string('location')->nullable(); // Lokasi pengguna

            // Informasi sosial dasar
            $table->date('birth_date')->nullable(); // Tanggal lahir
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Jenis kelamin

            // Status & aktivitas
            $table->boolean('is_active')->default(true); // Status akun aktif/tidak
            $table->timestamp('last_login_at')->nullable(); // Terakhir login

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
