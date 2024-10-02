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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervenant_phase_id')
                ->constrained()
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->foreignId('jury_phase_id');
            $table->foreign('jury_phase_id', 'entretiens_jury_id_foreign')
                ->references('id')
                ->on('juries')
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->longText(column: 'commentaire')->nullable();
            $table->string(column: 'appreciation')->nullable();
            $table->dateTime(column: 'date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
