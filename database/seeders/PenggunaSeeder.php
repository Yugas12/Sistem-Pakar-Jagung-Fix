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
                'kata_sandi' => 'admin123',
                'peran' => 'admin'
            ],
            [
                'id' => 2,
                'nama' => 'Wahyu Bagas',
                'email' => 'wahyubagas120903@gmail.com',
                'kata_sandi' => 'yugas123',
                'peran' => 'petani'
            ]
        ]);
    }
}
