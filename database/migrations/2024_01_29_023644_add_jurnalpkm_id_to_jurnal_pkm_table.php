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
        Schema::table('jurnal_pkm', function (Blueprint $table) {
            $table->unsignedBigInteger('jurnalpkm_id');
            $table->foreign('jurnalpkm_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurnal_pkm', function (Blueprint $table) {
            $table->dropForeign(['jurnalpkm_id']);
            $table->dropColumn('jurnalpkm_id');
        });
    }
};
