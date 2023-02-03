<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        $data = [
            [
                'nama_lengkap' => "Ibnu Syawal Aliefian",
                'email' => 'ibnuSyawal@gmail.com',
                'username' => 'TestData',
                'password' => Hash::make('Password'),
                'telp' => "082162941198"
            ],
            [
                'nama_lengkap' => "Akhmad Alwan Rabbani",
                'email' => 'AlwanCoding@gmail.com',
                'username' => 'ARRCoding',
                'password' => Hash::make('Password'),
                'telp' => "082162941194"
            ],
        ];

        User::insert($data);

        $this->call([
            LevelSeeder::class,
            PetugasSeeder::class
        ]);
    }
}
