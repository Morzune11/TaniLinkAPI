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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap komentar

            // 🔗 Relasi ke user dan post
            $table->unsignedBigInteger('user_id'); // siapa yang berkomentar
            $table->unsignedBigInteger('post_id'); // komentar milik post mana

            // Isi komentar
            $table->text('content'); // teks komentar
            $table->unsignedBigInteger('parent_id')->nullable();
            // untuk reply komentar lain (nested comment)

            $table->integer('likes_count')->default(0); // jumlah like komentar

            $table->timestamps(); // waktu dibuat & diperbarui

            // 🔗 Foreign key relationships
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // jika user dihapus, komentarnya ikut terhapus

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade'); // jika post dihapus, komentarnya juga dihapus

            // 🔗 Self relation untuk reply
            $table->foreign('parent_id')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
