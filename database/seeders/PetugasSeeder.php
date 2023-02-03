<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_petugas' => "Fattan Rizky Adrian",
                'email' => 'LetnanFattan@gmail.com',
                'username' => 'TestData',
                'password' => Hash::make('Password'),
                'telp' => "082162941198",
                'level_id' => "1"
            ],
        ];

        Petugas::insert($data);
    }
}
