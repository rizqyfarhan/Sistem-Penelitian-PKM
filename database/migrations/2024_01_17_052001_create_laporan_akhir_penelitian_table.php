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
            $table->unsignedInteger('laporan_akhir_id');
            $table->string('judul');
            $table->string('file');
            $table->timestamps();
            
            $table->foreign('laporan_akhir_id')->references('id')->on('proposal_penelitian')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_akhir_penelitian');
    }
};