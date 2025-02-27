<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel_jurnal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('penerbit');
            $table->string('tahun');
            $table->integer('volume');
            $table->integer('nomor');
            $table->string('halaman');
            $table->string('url');
            $table->string('file');
            $table->string('artikel_jurnal_nrk', 10);
            $table->timestamps();

            $table->foreign('artikel_jurnal_nrk')->references('nrk')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel_jurnal');
    }
};