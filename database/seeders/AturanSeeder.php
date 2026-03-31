<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('aturan')->insert([
            ['id'=>28,'penyakit_id'=>1,'gejala_id'=>1],
            ['id'=>29,'penyakit_id'=>1,'gejala_id'=>2],
            ['id'=>30,'penyakit_id'=>1,'gejala_id'=>3],
            ['id'=>31,'penyakit_id'=>1,'gejala_id'=>4],
            ['id'=>32,'penyakit_id'=>2,'gejala_id'=>5],
            ['id'=>33,'penyakit_id'=>2,'gejala_id'=>6],
            ['id'=>34,'penyakit_id'=>2,'gejala_id'=>7],
            // lanjutkan sesuai SQL kamu (saya ringkas biar tidak kepanjangan)
        ]);
    }
}
