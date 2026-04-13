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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('filiere_id')->constrained('filieres');
            $table->foreignId('annee_id')->constrained('annees_scolaires');
            $table->tinyInteger('semestre'); // 1 à 6
            $table->enum('type', ['normale', 'achevale', 'passerelle'])->default('normale');
            $table->date('date_inscription');
            $table->timestamps();

            // un étudiant ne peut pas être inscrit 2x au même semestre/année
            $table->unique(['etudiant_id', 'annee_id', 'semestre']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
