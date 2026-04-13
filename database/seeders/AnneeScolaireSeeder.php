<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnneeScolaire;

class AnneeScolaireSeeder extends Seeder
{
    public function run(): void
    {
        $annees = [
            ['libelle' => '2022-2023', 'en_cours' => false],
            ['libelle' => '2023-2024', 'en_cours' => false],
            ['libelle' => '2024-2025', 'en_cours' => true],
        ];

        foreach ($annees as $a) {
            AnneeScolaire::create($a);
        }
    }
}
