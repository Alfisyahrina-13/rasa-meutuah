<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wilayahs', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('slug')->unique();
            $t->string('julukan');
            $t->string('sajian');
            $t->text('deskripsi');
            $t->text('tempat');               // satu tempat per baris
            $t->string('emoji', 8)->default('📍');
            $t->string('gambar')->nullable();
            $t->unsignedTinyInteger('urutan')->default(0);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wilayahs');
    }
};
