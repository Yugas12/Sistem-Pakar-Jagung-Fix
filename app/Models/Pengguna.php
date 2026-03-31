<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

// Model Pengguna digunakan untuk merepresentasikan tabel 'pengguna'
// Model ini juga digunakan untuk proses autentikasi (login/logout)
// karena mewarisi class Authenticatable dari Laravel.
class Pengguna extends Authenticatable
{
    // Menentukan nama tabel yang digunakan
    protected $table = 'pengguna';

    // Field yang boleh diisi saat proses registrasi atau penyimpanan data pengguna
    protected $fillable = [
        'nama',       // Nama pengguna
        'email',      // Email untuk login
        'kata_sandi', // Password yang sudah di-hash
        'peran'       // Role pengguna (misal: admin / user)
    ];

    // Field yang disembunyikan saat data dikirim dalam bentuk array / JSON
    // Agar password tidak ikut tampil (keamanan sistem)
    protected $hidden = [
        'kata_sandi',
    ];

    // Method ini digunakan Laravel untuk mengambil password saat proses autentikasi
    // Karena di database menggunakan nama kolom 'kata_sandi',
    // bukan 'password' (default Laravel), maka perlu override method ini.
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
