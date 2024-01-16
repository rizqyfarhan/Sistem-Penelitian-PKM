<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposal_penelitian', function (Blueprint $table) {
            $table->enum('status', ['review', 'accept', 'reject'])->default('review')->change();
        });
    }

    public function down(): void
    {
        Schema::table('proposal_penelitian', function (Blueprint $table) {
            $table->enum('status', ['pending', 'checking', 'accept', 'reject'])->default('pending')->change();
        });
    }
};