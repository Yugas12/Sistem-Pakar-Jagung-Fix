<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('pengguna')->insert([
            [
                'id' => 1,
                'nama' => 'Admin Pakar',
                'email' => 'admin12@gmail.com',
                'kata_sandi' => '$2y$12$uDifidFLQPHfDaxgeDznUeNy50q536AopuSxICVdNZZZz9PhF8qlK',
                'peran' => 'admin'
            ],
            [
                'id' => 2,
                'nama' => 'Wahyu Bagas',
                'email' => 'wahyubagas120903@gmail.com',
                'kata_sandi' => '$2y$12$FuXEeqgSpZHyGjrjPNio/OAzyeFfdFlj1haPoLdKIjBX0Lp/L3jWy',
                'peran' => 'petani'
            ]
        ]);
    }
}
