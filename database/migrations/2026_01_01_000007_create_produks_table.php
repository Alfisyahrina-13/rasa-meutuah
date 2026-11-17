<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Tabel "produks" = daftar oleh-oleh.
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('slug')->unique();
            $t->string('perajin');
            $t->string('lokasi');
            $t->text('deskripsi');
            $t->text('fitur')->nullable();    // satu poin per baris
            $t->unsignedInteger('harga');
            $t->string('ukuran');
            $t->string('emoji', 8)->default('🎁');
            $t->string('gambar')->nullable();
            $t->boolean('unggulan')->default(false);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
