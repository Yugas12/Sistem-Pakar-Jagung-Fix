<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AturanSeeder extends Seeder
{
    public function run()
    {
        DB::table('aturan')->insert([

            // =====================
            // P1 - Bulai
            // =====================
            ['id'=>1,'penyakit_id'=>1,'gejala_id'=>1,'cf_pakar'=>0.6],
            ['id'=>2,'penyakit_id'=>1,'gejala_id'=>2,'cf_pakar'=>0.9],
            ['id'=>3,'penyakit_id'=>1,'gejala_id'=>3,'cf_pakar'=>0.6],
            ['id'=>4,'penyakit_id'=>1,'gejala_id'=>4,'cf_pakar'=>0.5],

            // =====================
            // P2 - Bercak Daun
            // =====================
            ['id'=>5,'penyakit_id'=>2,'gejala_id'=>5,'cf_pakar'=>0.8],
            ['id'=>6,'penyakit_id'=>2,'gejala_id'=>6,'cf_pakar'=>0.6],
            ['id'=>7,'penyakit_id'=>2,'gejala_id'=>7,'cf_pakar'=>0.7],

            // =====================
            // P3 - Busuk Pelepah
            // =====================
            ['id'=>8,'penyakit_id'=>3,'gejala_id'=>8,'cf_pakar'=>0.6],
            ['id'=>9,'penyakit_id'=>3,'gejala_id'=>9,'cf_pakar'=>0.8],
            ['id'=>10,'penyakit_id'=>3,'gejala_id'=>10,'cf_pakar'=>0.7],

            // =====================
            // P4 - Busuk Batang
            // =====================
            ['id'=>11,'penyakit_id'=>4,'gejala_id'=>11,'cf_pakar'=>0.7],
            ['id'=>12,'penyakit_id'=>4,'gejala_id'=>12,'cf_pakar'=>0.8],
            ['id'=>13,'penyakit_id'=>4,'gejala_id'=>13,'cf_pakar'=>0.9],
            ['id'=>14,'penyakit_id'=>4,'gejala_id'=>14,'cf_pakar'=>0.7],

            // =====================
            // P5 - Hawar Daun
            // =====================
            ['id'=>15,'penyakit_id'=>5,'gejala_id'=>15,'cf_pakar'=>0.7],
            ['id'=>16,'penyakit_id'=>5,'gejala_id'=>16,'cf_pakar'=>0.8],
            ['id'=>17,'penyakit_id'=>5,'gejala_id'=>17,'cf_pakar'=>0.6],
            ['id'=>18,'penyakit_id'=>5,'gejala_id'=>18,'cf_pakar'=>0.7],

        ]);
    }
}