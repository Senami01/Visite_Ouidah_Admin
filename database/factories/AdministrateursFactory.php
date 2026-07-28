<?php

namespace Database\Factories;

use App\Lib\TableName;
use App\Lib\FieldName;
use App\Lib\Constant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Administrateurs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Administrateurs>
 */
class AdministrateursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            FieldName::ID => (string) Str::uuid(),
            FieldName::NOM => $this->faker->lastName(),
            FieldName::PRENOM => $this->faker->firstName(),
            FieldName::EMAIL => $this->faker->unique()->safeEmail(),
            FieldName::TELEPHONE => $this->faker->phoneNumber(),
            FieldName::ADRESSE_RESIDENCE => $this->faker->address(),
            FieldName::MOT_DE_PASSE_HASH => Hash::make('password'),
            FieldName::ROLE => $this->faker->randomElement(['Administrateur Système', 'Administrateur Mairie', 'Opérateur Délégué']),
            FieldName::STATUT => $this->faker->randomElement([Constant::ACTIF, Constant::DESACTIVE]),
            FieldName::DERNIERE_CONNEXION => $this->faker->dateTimeThisYear(),
        ];
    }
}
