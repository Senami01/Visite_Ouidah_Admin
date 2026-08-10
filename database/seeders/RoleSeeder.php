<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Role;
use App\Lib\FieldName;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Admin',
                FieldName::DESCRIPTION => 'Gère tout le back-office',
            ],
             [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Maire',
                FieldName::DESCRIPTION => 'Donne l\'autorisation des visites sur les sites touristiques',
            ],
             [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Assistant_Maire',
                FieldName::DESCRIPTION => 'Assure les tâches administratives et logistiques pour le maire',
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Contrôleur d’accès',
                FieldName::DESCRIPTION => 'Controle l’accès aux sites touristiques et assure la sécurité des visiteurs',
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Gestionnaire',
                FieldName::DESCRIPTION => 'Gère les activités des guides touristiques',
            ],
        ];


        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
