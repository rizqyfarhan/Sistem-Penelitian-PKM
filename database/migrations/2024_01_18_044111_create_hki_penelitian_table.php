<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hki_penelitian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('nama_pemegang');
            $table->string('nomor_sertifikat');
            $table->string('file');
            $table->string('hki_penelitian_nrk', 10);
            $table->timestamps();

            $table->foreign('hki_penelitian_nrk')->references('nrk')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hki_penelitian');
    }
};