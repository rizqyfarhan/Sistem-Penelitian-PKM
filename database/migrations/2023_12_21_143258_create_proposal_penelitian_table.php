<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_penelitian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('ketua_peneliti');
            $table->string('nidn');
            $table->string('nrk');
            $table->string('program_studi');
            $table->string('semester');
            $table->string('tahun_akademik');
            $table->string('sumber_dana');
            $table->string('nama_pendana')->nullable();
            $table->bigInteger('jumlah_dana');
            $table->string('file');
            $table->enum('status', ['pending', 'checking', 'accept', 'reject'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal_penelitian');
    }
};