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
        Schema::create('jury_phases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_id')->constrained()
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->json('jury_id')->nullable();
            $table->string('type');
            $table->integer('ponderation_prive')->nullable();
            $table->integer('ponderation_public')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jury_phases');
    }
};
