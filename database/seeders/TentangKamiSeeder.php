<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TentangKamiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tentang_kami')->insert([
            [
                'id'=>1,
                'judul'=>'Tentang JagungKu',
                'deskripsi'=>'Sistem pakar JagungKu dikembangkan oleh Wahyu Bagas Prastyo untuk membantu petani mendiagnosis penyakit jagung hibrida.'
            ]
        ]);
    }
}
