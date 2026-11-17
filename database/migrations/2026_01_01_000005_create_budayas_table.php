<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budayas', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('slug')->unique();
            $t->string('kategori');
            $t->string('ringkasan');
            $t->text('deskripsi');
            $t->unsignedTinyInteger('menit')->default(4);
            $t->string('emoji', 8)->default('🏛️');
            $t->string('gambar')->nullable();
            $t->boolean('unggulan')->default(false);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budayas');
    }
};
