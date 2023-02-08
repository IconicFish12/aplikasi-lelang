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
            'username' => $this->faker->word(),
            'password' => Hash::make('Password'),
            'telp' => $this->faker->phoneNumber(15),
            'level_id' => $this->faker->numberBetween(1,2)
        ];
    }
}
