<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('penyakit')->insert([
            [
                'id' => 1,
                'kode' => 'P1',
                'nama' => 'Bulai',
                'deskripsi' => 'Penyakit akibat jamur menyebabkan daun menguning.',
                'solusi' => 'Cabut dan musnahkan tanaman...'
            ],
            [
                'id' => 2,
                'kode' => 'P2',
                'nama' => 'Bercak Daun',
                'deskripsi' => 'Daun muncul bercak coklat.',
                'solusi' => 'Potong dan buang daun...'
            ],
            [
                'id' => 3,
                'kode' => 'P3',
                'nama' => 'Busuk Pelepah',
                'deskripsi' => 'Pelepah membusuk.',
                'solusi' => 'Kurangi kelembaban...'
            ],
            [
                'id' => 4,
                'kode' => 'P4',
                'nama' => 'Busuk Batang',
                'deskripsi' => 'Batang lunak dan busuk.',
                'solusi' => 'Segera panen lebih awal...'
            ],
            [
                'id' => 5,
                'kode' => 'P5',
                'nama' => 'Hawar Daun',
                'deskripsi' => 'Daun kering dan mati.',
                'solusi' => 'Gunakan fungisida...'
            ],
        ]);
    }
}
