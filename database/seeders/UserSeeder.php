<?php

namespace Database\Seeders;

use App\Lib\Constant;
use App\Lib\FieldName;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'AGBOSSA',
                FieldName::PRENOM => 'Marc',
                FieldName::EMAIL => 'marcagbossa@test.com',
                FieldName::TELEPHONE => '0190909090',
                FieldName::ADRESSE => 'Cotonou',
                FieldName::TYPE => Constant::ADMINISTRATEUR,
                FieldName::PASSWORD => Hash::make('Admin###'),
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Admin')->value(FieldName::ID),
                FieldName::DERNIERE_CONNEXION => now()->subDays(3),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'SOHOU',
                FieldName::PRENOM => 'Aline',
                FieldName::EMAIL => 'alinesohou@test.com',
                FieldName::TELEPHONE => '0191919191',
                FieldName::ADRESSE => 'Ouidah',
                FieldName::TYPE => Constant::ADMINISTRATEUR,
                FieldName::PASSWORD => Hash::make('Maire###'),
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Maire')->value(FieldName::ID),
                FieldName::DERNIERE_CONNEXION => now()->subDays(8),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'TCHEOU',
                FieldName::PRENOM => 'Jean',
                FieldName::EMAIL => 'jeantcheou@test.com',
                FieldName::TELEPHONE => '0192929292',
                FieldName::ADRESSE => 'Ouidah',
                FieldName::TYPE => Constant::ADMINISTRATEUR,
                FieldName::PASSWORD => Hash::make('Assist###'),
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Assistant_Maire')->value(FieldName::ID),
                FieldName::DERNIERE_CONNEXION => now()->subDays(5),
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Ahouansou',
                FieldName::PRENOM => 'Kossi',
                FieldName::EMAIL => 'kossi.a@guides.bj',
                FieldName::TELEPHONE => '+22901020304',
                FieldName::DENOMINATION => 'GUI-OUI-0142',
                FieldName::SITE_WEB => 'https://kossi-ahouansou.visitouidah.bj/',
                FieldName::ADRESSE => 'Cotonou, Bénin',
                FieldName::LATITUDE => 6.3654,
                FieldName::LONGITUDE => 2.4183,
                FieldName::A_PROPOS => 'Kossi Ahouansou est un guide touristique agréé, passionné par l’histoire de Ouidah et la culture vodoun. Il met son expertise au service d’une expérience authentique et vivante.',
                FieldName::LANGUES_PARLEES => 'Français, Anglais, Fon',
                FieldName::SPECIALITES => 'Histoire, Vodoun',
                FieldName::DATE_AGREMENT => now()->subMonth(),
                FieldName::TYPE => Constant::ACTEUR_MOBILE,
                FieldName::PASSWORD => Hash::make('acteur###'), 
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Gestionnaire')->value(FieldName::ID),
                FieldName::STATUT => false,
                FieldName::TYPE_ACTEUR => Constant::GUIDE,
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Hounkpatin',
                FieldName::PRENOM => 'Aurélie',
                FieldName::EMAIL => 'aurelie.h@guides.bj',
                FieldName::TELEPHONE => '+22901030304',
                FieldName::DENOMINATION => 'GUI-OUI-0098',
                FieldName::SITE_WEB => 'https://aur-lie-hounkpatin.visitouidah.bj/',
                FieldName::ADRESSE => 'Ouidah, Bénin',
                FieldName::LATITUDE => 9.3654,
                FieldName::LONGITUDE => 2.4183,
                FieldName::A_PROPOS => 'Aurélie Hounkpatin est un guide touristique agréé, passionnée par les cultures et les musées d’Ouidah. Elle met son expertise au service d’une expérience authentique et vivante.',
                FieldName::LANGUES_PARLEES => 'Français, Espagnol',
                FieldName::SPECIALITES => 'Cultures, Musées',
                FieldName::DATE_AGREMENT => now()->subMonths(9),
                FieldName::TYPE => Constant::ACTEUR_MOBILE,
                FieldName::PASSWORD => Hash::make('acteur###'), 
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Gestionnaire')->value(FieldName::ID),
                FieldName::TYPE_ACTEUR => Constant::GUIDE,
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Agence Sun Travel Bénin',
                FieldName::EMAIL => 'contact@suntravel.bj',
                FieldName::TELEPHONE => '+22901024300',
                FieldName::DENOMINATION => 'AGE-OUI-0021',
                FieldName::SITE_WEB => 'https://agence-sun-travel-b-nin.visitouidah.bj/',
                FieldName::ADRESSE => 'Ouidah, Bénin',
                FieldName::LATITUDE => 9.3654,
                FieldName::LONGITUDE => 6.4183,
                FieldName::A_PROPOS => 'Agence Sun Travel Bénin est une agence de voyage agréée, spécialisée dans la promotion du tourisme en Bénin. Elle met son expertise au service d’une expérience authentique et vivante.',
                FieldName::LANGUES_PARLEES => 'Français, Anglais, Fon',
                FieldName::SPECIALITES => 'Tourisme, Voyage',
                FieldName::DATE_AGREMENT => now()->subMonths(12),
                FieldName::TYPE => Constant::ACTEUR_MOBILE,
                FieldName::PASSWORD => Hash::make('acteur###'), 
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Contrôleur d’accès')->value(FieldName::ID),
                FieldName::TYPE_ACTEUR => Constant::AGENCE,
            ],
            [
                FieldName::ID => (string) Str::uuid(),
                FieldName::NOM => 'Bénin Découverte',
                FieldName::EMAIL => 'hello@benindecouverte.bj',
                FieldName::TELEPHONE => '+22901924300',
                FieldName::DENOMINATION => 'HOT-OUI-0621',
                FieldName::SITE_WEB => 'https://b-nin-d-couverte.visitouidah.bj/',
                FieldName::ADRESSE => 'Ouidah, Bénin',
                FieldName::LATITUDE => 9.2654,
                FieldName::LONGITUDE => 6.783,
                FieldName::A_PROPOS => 'Bénin Découverte est un hôtel de voyage agréée, spécialisée dans la promotion du tourisme en Bénin. Elle met son expertise au service d’une expérience authentique et vivante.',
                FieldName::LANGUES_PARLEES => 'Français, Anglais, Allemand',
                FieldName::SPECIALITES => 'Circuits sur mesure',
                FieldName::DATE_AGREMENT => now()->subMonths(2),
                FieldName::TYPE => Constant::ACTEUR_MOBILE,
                FieldName::PASSWORD => Hash::make('acteur###'),
                FieldName::ROLE_ID => Role::where(FieldName::NOM, 'Contrôleur d’accès')->value(FieldName::ID), 
                FieldName::TYPE_ACTEUR => Constant::HOTEL,
            ]
        ];
        
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
