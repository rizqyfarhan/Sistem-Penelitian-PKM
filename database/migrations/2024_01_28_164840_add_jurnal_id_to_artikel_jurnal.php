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
        Schema::table('artikel_jurnal', function (Blueprint $table) {
            $table->unsignedBigInteger('jurnal_id');
            $table->foreign('jurnal_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artikel_jurnal', function (Blueprint $table) {
            $table->dropForeign(['jurnal_id']);
            $table->dropColumn('jurnal_id');
        });
    }
};