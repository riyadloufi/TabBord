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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->enum('grade', ['PA', 'PH', 'MC', 'MCH', 'PR', 'Vacataire', 'Autre']);
            $table->string('specialite', 150)->nullable();
            $table->year('annee_recrutement')->nullable();
            $table->enum('service', [
                'pedagogique', 'RH', 'scolarite',
                'finance', 'secretariat', 'direction', 'autre'
            ])->default('pedagogique');
            $table->foreignId('filiere_id')->nullable()->constrained('filieres')->nullOnDelete();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};
