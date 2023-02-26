<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->sentence(5),
            'harga_barang' => $this->faker->randomNumber(6, true),
            'kategori_id' => $this->faker->numberBetween(1, 15),
            'deskripsi_barang' => $this->faker->paragraph(3),
            'foto' => $this->faker->imageUrl(1918, 819, 'electronics'),
        ];
    }
}
