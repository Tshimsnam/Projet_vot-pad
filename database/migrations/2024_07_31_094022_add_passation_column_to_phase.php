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
        Schema::table('phases', function (Blueprint $table) {
            $table->integer('passation_nombre')->after('statut')->nullable();
            $table ->double('passation_pourcent')->after('statut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phases', function (Blueprint $table) {
            $table->dropColumn('passation_nombre');
            $table->dropColumn('passation_pourcent');
        });
    }
};
