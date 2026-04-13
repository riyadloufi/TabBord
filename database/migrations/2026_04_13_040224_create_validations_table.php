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
        Schema::create('validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules');
            $table->foreignId('annee_id')->constrained('annees_scolaires');
            $table->decimal('note_normale', 5, 2)->nullable();
            $table->decimal('note_rattrapage', 5, 2)->nullable();
            $table->enum('statut', ['valide', 'rattrapage', 'non_valide'])->nullable();
            $table->timestamps();

            $table->unique(['etudiant_id', 'module_id', 'annee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validations');
    }
};
