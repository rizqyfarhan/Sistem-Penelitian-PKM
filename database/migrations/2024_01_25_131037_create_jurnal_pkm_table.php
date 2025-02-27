<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jurnal_pkm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('penerbit');
            $table->string('tahun');
            $table->integer('volume');
            $table->integer('nomor');
            $table->string('halaman');
            $table->string('url');
            $table->string('file');
            $table->string('jurnal_pkm_nrk', 10);
            $table->timestamps();

            $table->foreign('jurnal_pkm_nrk')->references('nrk')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_pkm');
    }
};