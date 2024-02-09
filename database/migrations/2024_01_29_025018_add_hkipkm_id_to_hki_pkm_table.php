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
        Schema::table('hki_pkm', function (Blueprint $table) {
            $table->unsignedBigInteger('hkipkm_id');
            $table->foreign('hkipkm_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hki_pkm', function (Blueprint $table) {
            $table->dropForeign(['hkipkm_id']);
            $table->dropColumn('hkipkm_id');
        });
    }
};
