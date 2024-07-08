<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "intervenant_phase_id"=>fake()->randomDigit,
            "phase_jury_id"=>fake()->randomDigit,
            "phase_critere_id"=>fake()->randomDigit,
            "cote"=>fake()->numberBetween(0,100),
            "nombre"=>fake()->numberBetween(0,100),
            "isVerified"=>fake()->boolean(),
        ];
    }
}
