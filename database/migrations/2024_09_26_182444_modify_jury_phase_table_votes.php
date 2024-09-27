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
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_jury_phase_id_foreign');

            // Ajouter une nouvelle clé étrangère qui référence jury_id
            $table->foreign('jury_phase_id', 'votes_jury_id_foreign')
                ->references('id')
                ->on('juries') // Assurez-vous que la table cible est correcte (juries par exemple)
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
