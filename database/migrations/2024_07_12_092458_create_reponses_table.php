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
        Schema::create('reponses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervenant_id')
                ->constrained()
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->foreignId('question_phase_id')
                ->constrained()
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->foreignId('assertion_id')
                ->constrained()
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->foreignId('phase_id')
                ->constrained()
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->double('cote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponses');
    }
};
