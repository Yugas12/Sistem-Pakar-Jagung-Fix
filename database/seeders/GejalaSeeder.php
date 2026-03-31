<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('gejala')->insert([
            ['id'=>1,'kode'=>'G1','nama'=>'Jagung bewarna kuning'],
            ['id'=>2,'kode'=>'G2','nama'=>'Ada serbuk keputihan dibatang'],
            ['id'=>3,'kode'=>'G3','nama'=>'Batang berukuran kecil'],
            ['id'=>4,'kode'=>'G4','nama'=>'Lambatnya pertumbuhan tongkol'],
            ['id'=>5,'kode'=>'G5','nama'=>'Banyak bercak bulat hingga lonjang pada daun'],
            ['id'=>6,'kode'=>'G6','nama'=>'Bercak berwarna kuning pada daun'],
            ['id'=>7,'kode'=>'G7','nama'=>'Berwarna coklat pada tulang daun'],
            ['id'=>8,'kode'=>'G8','nama'=>'Terdapat bercak pada pelepah'],
            ['id'=>9,'kode'=>'G9','nama'=>'Bercak berwarna orange pada pelepah'],
            ['id'=>10,'kode'=>'G10','nama'=>'Terdapat bercak meluas pada pelepah'],
            ['id'=>11,'kode'=>'G11','nama'=>'Batang bawah berwarna coklat'],
            ['id'=>12,'kode'=>'G12','nama'=>'Batang lembab dan lunak'],
            ['id'=>13,'kode'=>'G13','nama'=>'Berbau busuk pada batang'],
            ['id'=>14,'kode'=>'G14','nama'=>'Batang mudah patah'],
            ['id'=>15,'kode'=>'G15','nama'=>'Adanya warna coklat pada tengah bercak'],
            ['id'=>16,'kode'=>'G16','nama'=>'Bercak berwarna coklat kehijauan pada daun'],
            ['id'=>17,'kode'=>'G17','nama'=>'Bercak berbentuk oval'],
            ['id'=>18,'kode'=>'G18','nama'=>'Terdapat warna hitam pada bercak'],
        ]);
    }
}
