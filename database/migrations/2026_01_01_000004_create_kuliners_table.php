<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuliners', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('slug')->unique();
            $t->string('jenis');
            $t->string('daerah');
            $t->string('ringkasan');
            $t->text('deskripsi');
            $t->text('bahan')->nullable();
            $t->string('waktu')->nullable();
            $t->string('porsi')->nullable();
            $t->text('langkah')->nullable();  // satu langkah per baris
            $t->string('emoji', 8)->default('🍽️');
            $t->string('gambar')->nullable();
            $t->boolean('unggulan')->default(false);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuliners');
    }
};
