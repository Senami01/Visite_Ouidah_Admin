<?php

namespace Database\Seeders;

use App\Lib\FieldName;
use App\Lib\Constant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Administrateurs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministrateursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $administrateurs = [];

        for ($i = 0; $i < 3; $i++) {
            $administrateurs[] = [
                FieldName::ID => (string) Str::uuid(), 
                FieldName::NOM => $faker->lastName(),
                FieldName::PRENOM => $faker->firstName(),
                FieldName::EMAIL => $faker->unique()->safeEmail(),
                FieldName::TELEPHONE => $faker->phoneNumber(),
                FieldName::ADRESSE_RESIDENCE => $faker->address(),
                FieldName::MOT_DE_PASSE_HASH => Hash::make('secret'), 
                FieldName::ROLE => $faker->randomElement([
                    Constant::ADMINISTRATEUR_SYSTEME, 
                    Constant::ADMINISTRATEUR_MAIRIE, 
                    Constant::OPERATEUR_DELEGUE, 
                    Constant::ADMINISTRATEUR_MINISTERE_TOURISME
                    ]),
                FieldName::STATUT => $faker->randomElement([Constant::ACTIF, Constant::DESACTIVE]),
                FieldName::DERNIERE_CONNEXION => $faker->dateTimeThisYear(),
            ];
        }
        
        foreach ($administrateurs as $admin) {
            Administrateurs::create($admin);
        }
    }
}
