<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Petugas>
 */
class PetugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_petugas' => $this->faker->name(),
            'email' => $this->faker->freeEmail(),
            'password' => Hash::make('Password'),
            'role' => $this->faker->randomElement(['admin', 'petugas']),
            'telp' => $this->faker->phoneNumber(15),
        ];
    }
}
