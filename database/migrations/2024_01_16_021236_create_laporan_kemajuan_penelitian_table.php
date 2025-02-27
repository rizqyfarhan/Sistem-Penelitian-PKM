<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kemajuan_penelitian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('laporan_kemajuan_nrk', 10);
            $table->string('judul');
            $table->string('file');
            $table->timestamps();
            
            $table->foreign('laporan_kemajuan_nrk')->references('nrk')->on('proposal_penelitian')->cascadeOnDelete();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('laporan_kemajuan_penelitian');
    }
};