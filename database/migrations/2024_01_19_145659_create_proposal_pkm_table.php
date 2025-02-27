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
        Schema::create('proposal_pkm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_nrk', 10);
            $table->string('judul');
            $table->string('nama_pelaksana');
            $table->string('nidn');
            $table->string('nrk');
            $table->string('program_studi');
            $table->string('semester');
            $table->string('tahun_akademik');
            $table->string('nama_mitra');
            $table->string('alamat_mitra');
            $table->string('file');
            $table->enum('status', ['review', 'accept', 'reject'])->default('review');
            $table->timestamps();
            
            $table->foreign('user_nrk')->references('nrk')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_pkm');
    }
};