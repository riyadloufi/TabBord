<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AnneeScolaireSeeder::class,
            FiliereSeeder::class,
            UserSeeder::class,
        ]);
    }
}
