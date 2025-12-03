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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // ID unik untuk post
            $table->unsignedBigInteger('user_id'); // Relasi ke user

            $table->text('content')->nullable(); // Isi status atau caption
            $table->string('image')->nullable(); // Gambar yang diunggah (jika ada)
            $table->string('video')->nullable(); // Video yang diunggah (jika ada)
            $table->enum('visibility', ['public', 'friends', 'private'])->default('public'); // Pengaturan privasi

            $table->integer('likes_count')->default(0); // Jumlah like
            $table->integer('comments_count')->default(0); // Jumlah komentar

            $table->timestamps(); // created_at & updated_at

            // 🔗 Relasi ke tabel users
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Jika user dihapus, postingan juga ikut terhapus
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
