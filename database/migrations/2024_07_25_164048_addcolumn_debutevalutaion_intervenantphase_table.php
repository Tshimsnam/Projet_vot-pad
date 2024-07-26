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
        Schema::table('intervenant_phases', function (Blueprint $table) {
            $table->timestamp('debut_evaluation', precision: 0)->after('token')->nullable();
            $table->timestamp('fin_evaluation', precision: 0)->after('debut_evaluation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intervenant_phases', function (Blueprint $table) {
            //
        });
    }
};
