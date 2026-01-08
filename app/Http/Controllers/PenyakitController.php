<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = [
            [
                'nama' => 'Bulai',
                'gejala' => 'Daun berwarna kekuningan dan pertumbuhan tanaman terhambat.',
                'gambar' => 'bulai.jpg'
            ],
            [
                'nama' => 'Karat Daun',
                'gejala' => 'Muncul bercak coklat kemerahan pada daun bagian bawah.',
                'gambar' => 'karat_daun.jpg'
            ],
            [
                'nama' => 'Busuk Batang',
                'gejala' => 'Batang menjadi lembek dan mudah patah.',
                'gambar' => 'busuk_batang.jpg'
            ],
            [
                'nama' => 'Hawar Daun',
                'gejala' => 'Daun jagung mengering dari ujung dan muncul bercak berwarna abu-abu kecoklatan.',
                'gambar' => 'hawar_daun.jpg'
            ],
            [
                'nama' => 'Bercak Daun',
                'gejala' => 'Terdapat bercak kecil berwarna coklat yang menyebar di permukaan daun.',
                'gambar' => 'bercak_daun.jpg'
            ],
            [
                'nama' => 'Busuk Pelepah',
                'gejala' => 'Pelepah daun menjadi lembek, berwarna coklat tua, dan berbau busuk.',
                'gambar' => 'busuk_pelepah.png'
            ],
        ];

        return view('admin.penyakit', compact('penyakit'));
    }
}
