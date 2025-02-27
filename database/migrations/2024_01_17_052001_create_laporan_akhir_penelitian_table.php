<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_akhir_penelitian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('laporan_akhir_nrk', 10);
            $table->string('judul');
            $table->string('file');
            $table->timestamps();
            
            $table->foreign('laporan_akhir_nrk')->references('nrk')->on('proposal_penelitian')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_akhir_penelitian');
    }
};