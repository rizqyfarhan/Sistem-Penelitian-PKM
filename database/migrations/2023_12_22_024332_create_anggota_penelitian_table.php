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
        Schema::create('anggota_penelitian', function (Blueprint $table) {
            $table->string('nrk', 10)->primary();
            $table->string('nama');
            $table->string('nidn', 10);
            $table->string('judul');
            $table->string('proposal_nrk', 10);
            $table->timestamps();

            $table->foreign('proposal_nrk')->references('nrk')->on('proposal_penelitian')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_penelitian');
    }
};