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
        Schema::create('ressources_materielles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_id')->constrained('locaux')->onDelete('cascade');
            $table->string('designation', 150);
            $table->enum('categorie', ['ordinateur', 'tableau', 'projecteur', 'mobilier', 'autre']);
            $table->integer('quantite')->default(1);
            $table->enum('etat', ['bon', 'acceptable', 'mauvais', 'hors_service'])->default('bon');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressources_materielles');
    }
};
