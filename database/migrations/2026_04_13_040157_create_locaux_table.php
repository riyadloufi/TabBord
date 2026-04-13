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
        Schema::create('locaux', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('nom', 100)->nullable();
            $table->enum('type', ['amphi', 'salle', 'labo', 'salle_info', 'autre']);
            $table->integer('capacite')->default(0);
            $table->integer('nbr_ordinateurs')->default(0);
            $table->integer('nbr_tableaux')->default(0);
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locaux');
    }
};
