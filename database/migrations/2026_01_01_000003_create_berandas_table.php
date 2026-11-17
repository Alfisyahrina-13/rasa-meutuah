<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berandas', function (Blueprint $t) {
            $t->id();
            $t->string('nama');               // judul situs
            $t->string('tagline');
            $t->text('deskripsi');
            $t->string('filosofi_judul');
            $t->text('filosofi_isi');         // satu paragraf per baris
            $t->string('cta_judul');
            $t->text('cta_teks');
            $t->string('gambar')->nullable(); // foto utama beranda
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berandas');
    }
};
