<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $t) {
            $t->id();
            $t->string('kode')->unique();
            $t->string('nama');
            $t->string('wa');
            $t->string('kota');
            $t->text('alamat');
            $t->text('catatan')->nullable();
            $t->json('items');
            $t->unsignedBigInteger('total');
            $t->string('status')->default('baru');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
