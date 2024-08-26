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
        Schema::table('intervenants', function (Blueprint $table) {
            //$table->dropColumn('groupe_id');
            $table->string('noms')->after('id');
            $table->string('telephone')->after('email')->nullable();
            $table->string('genre')->after('telephone')->nullable();
            $table->string('image')->default('No image')->after('genre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intervenants', function (Blueprint $table) {
            //
        });
    }
};
