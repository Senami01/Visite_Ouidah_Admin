<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Lib\FieldName;
use App\Models\Sites_Touristiques;
use App\Models\User;
Use App\Lib\Constant; // <-- AJOUT DE LA CONSTANTE

class SitesTouristiquesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         

        $sites = [
            [
                FieldName::NOM => "Temple des Pythons",
                FieldName::CATEGORIE => "Culturel",
                FieldName::LATITUDE => 6.3520,
                FieldName::LONGITUDE => 2.0780,
                FieldName::ACCES => "acces",
                FieldName::COURTE_DESCRIPTION => "Un temple dédié aux pythons sacrés, symbole de la culture vaudou.",
                FieldName::A_PROPOS_TITRE => "Histoire du Temple des Pythons Sacrés",
                FieldName::A_PROPOS_DESCRIPTION => "Le Temple des Pythons Sacrés est un lieu de culte vaudou où les pythons sont vénérés.",
                FieldName::CONSEILS_PRATIQUES => "Respectez les règles du temple et ne touchez pas les pythons.",
                FieldName::TYPE_TARIFICATION => "double",
                FieldName::OUVERT_24_7 => true,
                FieldName::STATUT => 'publie',
                FieldName::INDICATIONS => "Le site est accessible à pied depuis le centre-ville. Il est recommandé de porter des chaussures confortables.",
                FieldName::CREATED_BY => User::where([
                    FieldName::TYPE => Constant::ADMINISTRATEUR, // Changé pour la constante
                    FieldName::NOM => 'AGBOSSA',
                    FieldName::PRENOM => 'Marc'
                ])->value(FieldName::ID), 
                FieldName::ACTEUR_MOBILE_ID => User::where([
                    FieldName::TYPE => Constant::ACTEUR_MOBILE, // Changé pour la constante
                    FieldName::NOM => 'AGBOSSA',
                    FieldName::PRENOM => 'Marc'
                ])->value(FieldName::ID),
            ],
            [
                FieldName::NOM => "Porte du Non-Retour",
                FieldName::CATEGORIE => "Historique",
                FieldName::LATITUDE => 6.3520,
                FieldName::LONGITUDE => 2.0780,
                FieldName::ACCES => "acces",
                FieldName::COURTE_DESCRIPTION => "Monument commémoratif de la traite des esclaves.",
                FieldName::A_PROPOS_TITRE => "Histoire de la Porte du Non-Retour",
                FieldName::A_PROPOS_DESCRIPTION => "La Porte du Non-Retour est un symbole de la mémoire de la traite des esclaves.",
                FieldName::CONSEILS_PRATIQUES => "Visitez le site avec respect et prenez le temps de réfléchir à son histoire.",
                FieldName::TYPE_TARIFICATION => "unique",
                FieldName::OUVERT_24_7 => true,
                FieldName::STATUT => 'publie',
                FieldName::INDICATIONS => "Le site est accessible à pied depuis le centre-ville. Il est recommandé de porter des chaussures confortables.",
                 FieldName::CREATED_BY => User::where([
                    FieldName::TYPE => Constant::ADMINISTRATEUR, // Changé pour la constante
                    FieldName::NOM => 'SOHOU',
                    FieldName::PRENOM => 'Aline'
                ])->value(FieldName::ID), 
                FieldName::ACTEUR_MOBILE_ID => User::where([
                    FieldName::TYPE => Constant::ACTEUR_MOBILE, // Changé pour la constante
                    FieldName::NOM => 'SOHOU',
                    FieldName::PRENOM => 'Aline'
                ])->value(FieldName::ID),
            ],
        ];

        foreach ($sites as $site) {
            Sites_Touristiques::create($site);
        }
    }
}
