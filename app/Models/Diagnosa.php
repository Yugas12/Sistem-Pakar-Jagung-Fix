<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Model Diagnosa merepresentasikan tabel 'diagnosa'
// Tabel ini menyimpan hasil akhir proses diagnosa user,
// yaitu penyakit yang terdeteksi berdasarkan gejala yang dipilih.
class Diagnosa extends Model
{
    // Menentukan nama tabel yang digunakan
    protected $table = 'diagnosa';

    // Menonaktifkan timestamps karena tabel tidak memakai created_at & updated_at
    public $timestamps = false;

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'pengguna_id', // ID user yang melakukan diagnosa
        'penyakit_id', // ID penyakit hasil diagnosa
        'tanggal'      // Waktu diagnosa dilakukan
    ];

    // ===============================
    // ✅ RELASI KE PENGGUNA
    // ===============================
    // Setiap diagnosa dimiliki oleh satu pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // ===============================
    // ✅ RELASI KE TABEL PENYAKIT
    // ===============================
    // Menyimpan hasil penyakit dari proses Forward Chaining
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    // ===============================
    // ✅ RELASI KE DETAIL DIAGNOSA
    // ===============================
    // Satu diagnosa bisa memiliki banyak gejala yang dipilih user
    public function detailDiagnosa()
    {
        return $this->hasMany(DetailDiagnosa::class, 'diagnosa_id');
    }

    // ===============================
    // ✅ ACCESSOR GEJALA STRING
    // ===============================
    // Mengubah daftar gejala yang dipilih menjadi teks (misal: G01, G02, G03)
    // Biasanya digunakan untuk ditampilkan di tabel riwayat diagnosa
    public function getGejalaStringAttribute()
    {
        // Jika relasi belum diload, maka load detailDiagnosa beserta gejalanya
        if (!$this->relationLoaded('detailDiagnosa')) {
            $this->load('detailDiagnosa.gejala');
        }

        $gejalaKode = [];

        // Mengambil kode gejala satu per satu
        foreach ($this->detailDiagnosa as $detail) {
            if ($detail->gejala) {
                $gejalaKode[] = $detail->gejala->kode;
            }
        }

        // Menggabungkan menjadi string dipisahkan koma
        return implode(', ', $gejalaKode) ?: '-';
    }

    // ===============================
    // ✅ ACCESSOR SOLUSI SINGKAT
    // ===============================
    // Menampilkan solusi penyakit dalam bentuk ringkasan (dibatasi 100 karakter)
    public function getSolusiSingkatAttribute()
    {
        if ($this->penyakit && $this->penyakit->solusi) {
            return Str::limit($this->penyakit->solusi, 100);
        }

        return '-';
    }

    // ===============================
    // ✅ ACCESSOR FORMAT TANGGAL
    // ===============================
    // Mengubah format tanggal database menjadi format tampilan
    // Contoh: 14/02/2026 10:30:15
    public function getTanggalFormatAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal)
            ->format('d/m/Y H:i:s');
    }
}
