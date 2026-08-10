<?php

namespace Database\Seeders;

use App\Lib\FieldName;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $administrateurs = [
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'AGBOSSA',
                FieldName::PRENOM => 'Marc',
                FieldName::EMAIL => 'marcagbossa@test.com',
                FieldName::TELEPHONE => '0190909090',
                FieldName::ADRESSE_RESIDENCE => 'Cotonou',
                FieldName::MOT_DE_PASSE_HASH => Hash::make('Admin###'),
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Admin')->value(FieldName::ID),
                FieldName::DERNIERE_CONNEXION => now()->subDays(3),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'SOHOU',
                FieldName::PRENOM => 'Aline',
                FieldName::EMAIL => 'alinesohou@test.com',
                FieldName::TELEPHONE => '0191919191',
                FieldName::ADRESSE_RESIDENCE => 'Ouidah',
                FieldName::MOT_DE_PASSE_HASH => Hash::make('Maire###'),
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Maire')->value(FieldName::ID),
                FieldName::STATUT => false,
                FieldName::DERNIERE_CONNEXION => now()->subDays(8),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'TCHEOU',
                FieldName::PRENOM => 'Jean',
                FieldName::EMAIL => 'jeantcheou@test.com',
                FieldName::TELEPHONE => '0192929292',
                FieldName::ADRESSE_RESIDENCE => 'Ouidah',
                FieldName::MOT_DE_PASSE_HASH => Hash::make('Assist###'),
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Assistant_Maire')->value(FieldName::ID),
                FieldName::DERNIERE_CONNEXION => now()->subDays(5),
            ]
        ];
        
        foreach ($administrateurs as $admin) {
            User::create($admin);
        }
    }
}
