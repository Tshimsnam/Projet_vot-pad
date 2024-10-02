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
        Schema::table('juries', function (Blueprint $table) {
            $table->string('noms')->after('id')->nullable();
            $table->string('type')->default('entretien')->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('juries', function (Blueprint $table) {
            //
        });
    }
};
