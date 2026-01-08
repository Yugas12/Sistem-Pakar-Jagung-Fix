<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| File ini berisi semua route web untuk aplikasi Sistem Pakar Jagung.
| Sudah disesuaikan agar sepenuhnya terhubung dengan LoginController dan RegisterController.
| Setiap route memiliki nama yang jelas untuk dipanggil di Blade dengan route('nama').
*/

// 🏠 Halaman Home
Route::get('/', function () {
    return view('user.home');
})->name('home');

// 🌽 Halaman Diagnosis
Route::get('/diagnosis', [DiagnosisController::class, 'index'])->name('diagnosis');

// 🔍 Proses hasil diagnosis
Route::post('/diagnosis/proses', [DiagnosisController::class, 'proses'])->name('diagnosis.proses');

// 📘 Halaman Informasi Penyakit
Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit');

// ℹ️ Halaman Tentang Kami
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

// --------------------------------------------------
// 🔐 AUTENTIKASI (Login, Register, Logout)
// --------------------------------------------------

// 🔸 Menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');

// 🔸 Proses login user
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest')
    ->name('login.submit');

// 🔸 Menampilkan form registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->middleware('guest')
    ->name('register');

// 🔸 Proses data registrasi
Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest')
    ->name('register.submit');

// 🔸 Logout user (POST)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// --------------------------------------------------
// 🧩 Contoh Route untuk halaman yang hanya bisa diakses jika login
// --------------------------------------------------

// Contoh: halaman riwayat diagnosis (hanya untuk user login)
Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat', [DiagnosisController::class, 'riwayat'])->name('riwayat');
});

// ============================
// Halaman Admin (Tampilan sementara)
// ============================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/gejala', function () {
    // Data dummy untuk tampilan sementara
    $gejala = [
        ['id' => 1, 'kode' => 'G01', 'nama' => 'Daun menguning'],
        ['id' => 2, 'kode' => 'G02', 'nama' => 'Bercak coklat pada daun'],
        ['id' => 3, 'kode' => 'G03', 'nama' => 'Batang membusuk'],
    ];
    return view('admin.gejala', compact('gejala'));
})->name('admin.gejala');

Route::get('/admin/penyakit', function () {
    // Data dummy untuk tampilan sementara
    $penyakit = [
        ['id' => 1, 'kode' => 'P01', 'nama' => 'Bulai', 'deskripsi' => 'Daun jagung berubah warna kekuningan'],
        ['id' => 2, 'kode' => 'P02', 'nama' => 'Hawar Daun', 'deskripsi' => 'Daun terdapat bercak-bercak coklat'],
    ];
    return view('admin.penyakit', compact('penyakit'));
})->name('admin.penyakit');

Route::get('/admin/relasi', function () {
    // Data dummy untuk tampilan sementara
    $relasi = [
        ['id' => 1, 'penyakit' => 'Bulai', 'gejala' => 'Daun menguning'],
        ['id' => 2, 'penyakit' => 'Hawar Daun', 'gejala' => 'Bercak coklat pada daun'],
    ];
    return view('admin.relasi', compact('relasi'));
})->name('admin.relasi');


// ============================
// Route POST Dummy (sementara)
// ============================

Route::post('/admin/gejala/store', function () {
    return back()->with('success', '✅ Data gejala berhasil disimpan (dummy).');
})->name('admin.gejala.store');

Route::post('/admin/penyakit/store', function () {
    return back()->with('success', '✅ Data penyakit berhasil disimpan (dummy).');
})->name('admin.penyakit.store');

Route::post('/admin/relasi/store', function () {
    return back()->with('success', '✅ Relasi penyakit-gejala berhasil disimpan (dummy).');
})->name('admin.relasi.store');



