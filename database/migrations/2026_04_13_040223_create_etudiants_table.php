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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('CNE', 20)->unique();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->enum('sexe', ['M', 'F']);
            $table->date('date_naissance')->nullable();
            $table->enum('type_acces', ['normal', 'passerelle'])->default('normal');
            $table->tinyInteger('semestre_entree')->default(1); // 1 ou 5
            $table->enum('statut', ['actif', 'abandon', 'diplome', 'transfert'])->default('actif');
            $table->string('nationalite', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
