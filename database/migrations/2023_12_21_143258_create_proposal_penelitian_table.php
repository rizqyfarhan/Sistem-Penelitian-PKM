<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_penelitian', function (Blueprint $table) {
            $table->string('judul');
            $table->string('ketua_peneliti');
            $table->string('nidn', 10)->unique();
            $table->string('nrk', 10)->primary();
            $table->string('program_studi');
            $table->string('semester');
            $table->string('tahun_akademik');
            $table->string('sumber_dana');
            $table->string('nama_pendana')->nullable();
            $table->bigInteger('jumlah_dana');
            $table->string('file');
            $table->enum('status', ['review', 'accept', 'reject'])->default('review');
            $table->string('user_nrk', 10);
            $table->timestamps();

            $table->foreign('user_nrk')->references('nrk')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal_penelitian');
    }
};