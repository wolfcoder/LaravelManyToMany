<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        // init faker with locale id_ID
        $faker = \Faker\Factory::create('id_ID');

        // init stable faker for consistent data
        $faker->seed(1234);

        //create simple list array of mata kuliah
        $mataKuliah = [
            'Pemrograman Berbasis Objek',
            'Pemrograman Web',
            'Sistem Basis Data',
            'Sistem Informasi Geografis',];

        // create 20 mahasiswa using mass assignment using loop
        for ($i = 0; $i < 20; $i++) {
            \App\Models\Mahasiswa::create([
                'nim' => $faker->unique()->numerify('10######'),
                'nama' => $faker->firstName . ' ' . $faker->lastName,
                'jurusan' => $faker->randomElement($mataKuliah),
            ]);
        }

        // create 5 matakuliah using single mass assignment
        \App\Models\Matakuliah::insert([
            [
                'kode' => 'PBO',
                'nama' => 'Pemrograman Berbasis Objek',
                'jumlah_sks' => 3,
            ],
            [
                'kode' => 'PW',
                'nama' => 'Pemrograman Web',
                'jumlah_sks' => 3,
            ],
            [
                'kode' => 'SBD',
                'nama' => 'Sistem Basis Data',
                'jumlah_sks' => 3,
            ],
            [
                'kode' => 'SIG',
                'nama' => 'Sistem Informasi Geografis',
                'jumlah_sks' => 3,
            ],
            [
                'kode' => 'PL',
                'nama' => 'Pemrograman Lanjut',
                'jumlah_sks' => 3,
            ],
        ]);

    }
}
