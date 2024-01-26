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
        Schema::create('laporan_kemajuan_pkm', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kemajuan_pkm_id');
            $table->string('judul');
            $table->string('file');
            $table->timestamps();

            $table->foreign('kemajuan_pkm_id')->references('id')->on('proposal_pkm')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_laporan_kemajuan_pkm');
    }
};