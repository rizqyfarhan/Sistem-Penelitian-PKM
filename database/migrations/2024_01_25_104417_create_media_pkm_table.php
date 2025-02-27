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
        Schema::create('media_pkm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('nama_media');
            $table->string('bulan_terbit');
            $table->string('tahun_terbit');
            $table->string('url');
            $table->string('media_pkm_nrk', 10);
            $table->timestamps();

            $table->foreign('media_pkm_nrk')->references('nrk')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_pkm');
    }
};