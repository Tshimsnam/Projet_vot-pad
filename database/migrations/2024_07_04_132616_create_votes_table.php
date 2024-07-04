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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervenant_phase_id')
            ->constrained()
            ->onDelete('no action')
            ->onUpdate('cascade'); 
            $table->foreignId('phase_jury_id')
            ->constrained()
            ->onDelete('no action')
            ->onUpdate('cascade');
            $table->foreignId('phase_critere_id')
            ->constrained()
            ->onDelete('no action')
            ->onUpdate('cascade');
            $table->integer('cote');
            $table->integer('nombre');
            $table->boolean('isVerified');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
