<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Lib\FieldName;
use App\Lib\Constant; // <-- AJOUT DE LA CONSTANTE
use App\Models\Utilisateurs_Mobile;
use App\Models\User;

class Utilisateurs_MobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sites = [
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Amélie',
                FieldName::PRENOM => 'Dubois',
                FieldName::EMAIL => 'amelie.dubois@gmail.com',
                FieldName::TELEPHONE => '+33 6 12 44 87 09',
                FieldName::PAYS => 'Bénin',
                FieldName::ROLE => 'Contrôleur d’accès',
                FieldName::ACTEUR_MOBILE_ID => User::where([
                    FieldName::TYPE => Constant::ACTEUR_MOBILE, // Changé pour la constante
                    FieldName::TYPE_ACTEUR => Constant::GUIDE,  // Changé pour la constante
                    FieldName::NOM => 'Hounkpatin',
                    FieldName::PRENOM => 'Aurélie'
                ])->value(FieldName::ID),
                FieldName::STATUT => 'actif',
                FieldName::DERNIERE_CONNEXION => now(),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'James',
                FieldName::PRENOM => 'Carter',
                FieldName::EMAIL => 'jcarter@outlook.com',
                FieldName::TELEPHONE => '+1 415 552 0188',
                FieldName::PAYS => 'France',
                FieldName::ROLE => 'Gestionnaire',
                FieldName::ACTEUR_MOBILE_ID => User::where(FieldName::TYPE_ACTEUR, Constant::AGENCE) // Changé pour la constante
                    ->where(FieldName::NOM, 'Agence Sun Travel Bénin')
                    ->value(FieldName::ID),
                FieldName::STATUT => 'actif',
                FieldName::DERNIERE_CONNEXION => now(),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Admin',
                FieldName::PRENOM => 'Admin',
                FieldName::EMAIL => 'admin@example.com',
                FieldName::TELEPHONE => '1234567890',
                FieldName::PAYS => 'Bénin',
                FieldName::ROLE => 'Admin',
                FieldName::ACTEUR_MOBILE_ID => User::where(FieldName::TYPE_ACTEUR, Constant::HOTEL) // Changé pour la constante
                    ->where(FieldName::NOM, 'Bénin Découverte')
                    ->value(FieldName::ID),
                FieldName::STATUT => 'actif',
                FieldName::DERNIERE_CONNEXION => now(),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Kossi',
                FieldName::PRENOM => 'Adjévi',
                FieldName::EMAIL => 'kossi.adjevi@yahoo.fr',
                FieldName::TELEPHONE => '+228 90 21 55 03',
                FieldName::PAYS => 'Togo',
                FieldName::ROLE => 'Contrôleur d’accès',
                FieldName::ACTEUR_MOBILE_ID => User::where(FieldName::TYPE_ACTEUR, Constant::HOTEL) // Changé pour la constante
                    ->where(FieldName::NOM, 'Bénin Découverte')
                    ->value(FieldName::ID),
                FieldName::STATUT => 'actif',
                FieldName::DERNIERE_CONNEXION => now(),
            ],
        ];

        foreach ($sites as $site) {
            Utilisateurs_Mobile::create($site);
        }
    }
}
