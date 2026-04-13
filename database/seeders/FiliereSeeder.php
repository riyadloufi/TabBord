<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filiere;
use App\Models\Module;

class FiliereSeeder extends Seeder
{
    public function run(): void
    {
        $filieres = [
            ['code' => 'INFO-LP',  'intitule' => 'Licence Professionnelle Informatique', 'type' => 'LP',     'nbr_semestres' => 6],
            ['code' => 'GC-LP',    'intitule' => 'Licence Professionnelle Génie Civil',  'type' => 'LP',     'nbr_semestres' => 6],
            ['code' => 'INFO-MST', 'intitule' => 'Master Sciences et Techniques Info',   'type' => 'Master', 'nbr_semestres' => 4],
        ];

        foreach ($filieres as $f) {
            $filiere = Filiere::create($f);

            // Modules de base pour INFO-LP
            if ($filiere->code === 'INFO-LP') {
                $modules = [
                    ['semestre' => 1, 'code' => 'ALGO1',  'intitule' => 'Algorithmique 1',       'credits' => 3, 'coefficient' => 2],
                    ['semestre' => 1, 'code' => 'PROG1',  'intitule' => 'Programmation C',        'credits' => 3, 'coefficient' => 2],
                    ['semestre' => 1, 'code' => 'MATH1',  'intitule' => 'Mathématiques 1',        'credits' => 2, 'coefficient' => 1.5],
                    ['semestre' => 2, 'code' => 'ALGO2',  'intitule' => 'Algorithmique 2',        'credits' => 3, 'coefficient' => 2],
                    ['semestre' => 2, 'code' => 'BDD1',   'intitule' => 'Base de données',        'credits' => 3, 'coefficient' => 2],
                    ['semestre' => 3, 'code' => 'WEB1',   'intitule' => 'Développement Web',      'credits' => 3, 'coefficient' => 2],
                    ['semestre' => 4, 'code' => 'LARAVEL','intitule' => 'Frameworks PHP Laravel', 'credits' => 3, 'coefficient' => 2],
                    ['semestre' => 5, 'code' => 'STAGE',  'intitule' => 'Stage en entreprise',    'credits' => 6, 'coefficient' => 4],
                ];
                foreach ($modules as $m) {
                    $filiere->modules()->create($m);
                }
            }
        }
    }
}
