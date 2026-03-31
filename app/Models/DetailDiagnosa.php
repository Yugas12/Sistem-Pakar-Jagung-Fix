<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model DetailDiagnosa merepresentasikan tabel 'detail_diagnosa'
// Tabel ini digunakan untuk menyimpan data gejala yang dipilih
// oleh user pada saat melakukan proses diagnosa.
class DetailDiagnosa extends Model 
{
    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'detail_diagnosa';

    // Field yang boleh diisi secara mass assignment
    // diagnosa_id : ID dari proses diagnosa
    // gejala_id   : ID gejala yang dipilih user
    protected $fillable = ['diagnosa_id', 'gejala_id'];

    // Menonaktifkan timestamps karena tabel tidak memiliki
    // kolom created_at dan updated_at
    public $timestamps = false;

    // ✅ RELASI KE GEJALA
    // Setiap detail diagnosa terhubung dengan satu gejala
    // Digunakan untuk mengambil informasi gejala yang dipilih user
    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }

    // ✅ RELASI KE DIAGNOSA
    // Setiap detail diagnosa merupakan bagian dari satu diagnosa
    // (satu proses diagnosa bisa memiliki banyak gejala)
    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class, 'diagnosa_id');
    }
}
