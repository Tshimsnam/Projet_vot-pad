<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evenement>
 */
class EvenementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>$this->faker->unique()->numerify('Compétition ##'),
            'description'=>$this->faker->unique()->sentence(),
            'date_debut'=>$this->faker->unique()->date(),
            'date_fin'=>$this->faker->unique()->date(),
            'type'=>$this->faker->randomElement(['Compétition', 'Evaluation']),
            'status'=>$this->faker->randomElement(['en cours','en attente','fermer']),
        ];
    }
}
