<?php

namespace Database\Factories;

use App\Models\User;  // Changez pour utiliser le modèle User
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SuperMomekanoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;  // Définissez User comme modèle

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Super Admin',
            'email' => 'super@momekano.com',
            'password' => bcrypt('passMomekano'),
            'role' => 'super-momekano',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}