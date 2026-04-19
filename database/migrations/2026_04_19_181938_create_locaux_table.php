
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('locaux', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('capacite')->default(0);
            $table->string('type')->nullable(); // salle, labo...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locaux');
    }
};
