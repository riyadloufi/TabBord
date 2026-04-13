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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filiere_id')->constrained('filieres')->onDelete('cascade');
            $table->string('code', 20);
            $table->string('intitule', 150);
            $table->tinyInteger('semestre'); // 1 à 6
            $table->decimal('credits', 4, 2)->nullable();
            $table->decimal('coefficient', 4, 2)->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();

            $table->unique(['filiere_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
