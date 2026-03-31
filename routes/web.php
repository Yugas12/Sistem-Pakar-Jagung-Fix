<?php

use Illuminate\Support\Facades\Route;

// ================== CONTROLLER USER ==================
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RiwayatController;

// ================== CONTROLLER ADMIN ==================
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPenyakitController;
use App\Http\Controllers\Admin\AdminGejalaController;
use App\Http\Controllers\Admin\AdminAturanController;


/*
|--------------------------------------------------------------------------
| ROUTE USER (TIDAK DIUBAH LOGIKANYA)
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('user.home');
})->name('home');

// Halaman diagnosa
Route::get('/diagnosis', [DiagnosisController::class, 'index'])
    ->name('diagnosis');

// Proses diagnosa
Route::post('/diagnosis/proses', [DiagnosisController::class, 'proses'])
    ->name('diagnosis.proses');

// Daftar penyakit
Route::get('/penyakit', [PenyakitController::class, 'index'])
    ->name('penyakit');

// Tentang kami
Route::get('/tentang', [TentangController::class, 'index'])
    ->name('tentang');

// Simpan hasil diagnosa (harus login)
Route::post('/diagnosa/simpan', [DiagnosisController::class, 'simpan'])
    ->middleware('auth')
    ->name('diagnosa.simpan');


/*
|--------------------------------------------------------------------------
| AUTH (LOGIN, REGISTER, LOGOUT)
|--------------------------------------------------------------------------
*/

// Form login
Route::get('/login', [AuthController::class, 'loginForm'])
    ->middleware('guest')
    ->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

// Form register
Route::get('/register', [AuthController::class, 'registerForm'])
    ->middleware('guest')
    ->name('register');

// Proses register
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| USER SETELAH LOGIN (PETANI)
|--------------------------------------------------------------------------
*/

// Riwayat diagnosa milik user (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('riwayat');
});


/*
|--------------------------------------------------------------------------
| ADMIN (DIKUNCI PAKAI is_admin)
|--------------------------------------------------------------------------
| Hanya user dengan peran = 'admin' yang bisa masuk prefix /admin
*/

Route::middleware(['auth', 'is_admin']) // ⬅️ KUNCI ADMIN DI SINI
    ->prefix('admin')                  // semua url diawali /admin
    ->name('admin.')                  // semua nama route diawali admin.
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        //CRUD Diagnosa Admin
        Route::delete('diagnosa/{id}', [App\Http\Controllers\Admin\AdminDiagnosaController::class, 'destroy'])
        ->name('diagnosa.destroy');

        // CRUD Penyakit
        Route::resource('penyakit', AdminPenyakitController::class);

        // CRUD Gejala
        Route::resource('gejala', AdminGejalaController::class);

        // ATURAN
        Route::get('aturan', [AdminAturanController::class, 'index'])
            ->name('aturan.index');

        Route::get('aturan/create', [AdminAturanController::class, 'create'])
            ->name('aturan.create');

        Route::post('aturan', [AdminAturanController::class, 'store'])
            ->name('aturan.store');

        Route::get('aturan/{penyakitId}/edit', [AdminAturanController::class, 'edit'])
            ->name('aturan.edit');

        Route::put('aturan/{penyakitId}', [AdminAturanController::class, 'update'])
            ->name('aturan.update');

        Route::delete('aturan/{penyakitId}/delete',[AdminAturanController::class,'deleteByPenyakit'])
            ->name('aturan.deleteByPenyakit');

    });
