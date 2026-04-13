<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin Système',    'email' => 'admin@faculte.ma',       'role' => 'admin'],
            ['name' => 'Agent Admin',      'email' => 'agent@faculte.ma',       'role' => 'agent'],
            ['name' => 'Responsable FAC',  'email' => 'responsable@faculte.ma', 'role' => 'responsable'],
            ['name' => 'Prof Benali',      'email' => 'enseignant@faculte.ma',  'role' => 'enseignant'],
        ];

        foreach ($users as $u) {
            User::create([
                ...$u,
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
