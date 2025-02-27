<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('nrk', 10)->primary();
            $table->string('nidn', 10)->nullable()->unique();
            $table->string('name');
            $table->string('password');
            $table->string('role')->default('dosen');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};