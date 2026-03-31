<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Model User digunakan oleh Laravel untuk sistem autentikasi bawaan
// (login, session, middleware auth, dll).
// Model ini tetap menggunakan tabel 'pengguna' agar sesuai dengan database yang sudah dibuat.
class User extends Authenticatable
{
    // Trait Notifiable digunakan jika ingin mengirim notifikasi
    // seperti email verifikasi, reset password, dll.
    use Notifiable;

    // Menentukan bahwa model ini menggunakan tabel 'pengguna'
    // (karena default Laravel seharusnya tabel 'users')
    protected $table = 'pengguna'; // WAJIB

    // Field yang boleh diisi saat registrasi atau penyimpanan data user
    protected $fillable = [
        'nama',       // Nama pengguna
        'email',      // Email untuk login
        'kata_sandi', // Password yang sudah di-hash
        'peran',      // Role pengguna (admin / user)
    ];

    // Field yang disembunyikan agar tidak ikut tampil saat data dipanggil
    protected $hidden = [
        'kata_sandi',
    ];

    // Laravel secara default mencari kolom 'password'
    // Karena di database menggunakan 'kata_sandi',
    // maka method ini mengarahkan Laravel ke kolom yang benar.
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
