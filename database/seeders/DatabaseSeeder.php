<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Petugas::factory(10)->create();
        Kategori::factory(15)->create();
        Barang::factory(30)->create();

        $data = [
            [
                'nama_lengkap' => "Ibnu Syawal Aliefian",
                'email' => 'ibnuSyawal@gmail.com',
                'password' => Hash::make('Password'),
                'telp' => "082162941198"
            ],
            [
                'nama_lengkap' => "Akhmad Alwan Rabbani",
                'email' => 'AlwanCoding@gmail.com',
                'password' => Hash::make('Password'),
                'telp' => "082162941194"
            ],
            [
                'nama_lengkap' => "Muhammad sholeh",
                'email' => 'VArlotte@gmail.com',
                'password' => Hash::make('Password'),
                'telp' => "082162941192"
            ],
            [
                'nama_lengkap' => "Muhammad Rezzqi Rabbani",
                'email' => 'VanStrong@gmail.com',
                'password' => Hash::make('Password'),
                'telp' => "082162941193"
            ],
        ];

        User::insert($data);

    }
}
