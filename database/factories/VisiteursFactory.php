<?php

namespace Database\Factories;

use App\Lib\FieldName;
use Illuminate\Support\Str;
use App\Models\Visiteurs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visiteurs>
 */
class VisiteursFactory extends Factory
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
            FieldName::PAYS => $this->faker->country(),
            FieldName::EMAIL => $this->faker->unique()->safeEmail(),
            FieldName::TELEPHONE => $this->faker->phoneNumber(),
        ];
    }
}
