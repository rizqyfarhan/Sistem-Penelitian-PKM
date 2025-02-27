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
        Schema::create('hki_pkm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('nama_pemegang');
            $table->string('nomor_sertifikat');
            $table->string('file');
            $table->string('hki_pkm_nrk', 10);
            $table->timestamps();

            $table->foreign('hki_pkm_nrk')->references('nrk')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hki_pkm');
    }
};