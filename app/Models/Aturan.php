<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Aturan merepresentasikan tabel 'aturan' di database
// Tabel ini digunakan sebagai basis pengetahuan
// pada sistem pakar diagnosis penyakit jagung hibrida
// menggunakan metode Forward Chaining dan Certainty Factor.
class Aturan extends Model
{
    // =====================================================
    // NAMA TABEL
    // =====================================================
    protected $table = 'aturan';

    // =====================================================
    // NONAKTIFKAN TIMESTAMP
    // =====================================================
    // Karena tabel aturan tidak menggunakan
    // created_at dan updated_at
    public $timestamps = false;

    // =====================================================
    // FIELD YANG BOLEH DIISI
    // =====================================================
    // penyakit_id : ID penyakit
    // gejala_id   : ID gejala
    // cf_pakar    : Nilai keyakinan pakar
    protected $fillable = [

        'penyakit_id',

        'gejala_id',

        'cf_pakar'

    ];

    // =====================================================
    // RELASI KE PENYAKIT
    // =====================================================
    // Setiap aturan dimiliki oleh satu penyakit
    public function penyakit()
    {
        return $this->belongsTo(
            Penyakit::class,
            'penyakit_id'
        );
    }

    // =====================================================
    // RELASI KE GEJALA
    // =====================================================
    // Setiap aturan terhubung dengan satu gejala
    public function gejala()
    {
        return $this->belongsTo(
            Gejala::class,
            'gejala_id'
        );
    }
}