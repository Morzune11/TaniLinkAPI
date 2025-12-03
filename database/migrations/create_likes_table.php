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
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap like

            // 🔗 Relasi utama
            $table->unsignedBigInteger('user_id'); // siapa yang memberi like
            $table->unsignedBigInteger('post_id')->nullable(); // bisa like post
            $table->unsignedBigInteger('comment_id')->nullable(); // atau like komentar

            // tipe reaksi (opsional — bisa dikembangkan seperti Facebook)
            $table->enum('reaction_type', ['like', 'love', 'care', 'haha', 'wow', 'sad', 'angry'])
                ->default('like');

            $table->timestamps();

            // 🔗 Foreign key relationships
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade');

            // 🚫 Agar 1 user tidak bisa like dua kali konten yang sama
            $table->unique(['user_id', 'post_id', 'comment_id'], 'unique_user_like');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
