<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/salam', function () {
    return 'Salam Kenal';
});

Route::get('hello', 'App\Http\Controllers\HelloController@index');
Route::get('biodata', 'App\Http\Controllers\HelloController@biodata');

Route::get('/tampilmahasiswa', 'App\Http\Controllers\MahasiswaController@tampil');
Route::get('/detilmahasiswa/{id}', 'App\Http\Controllers\MahasiswaController@detil');
Route::get('/datamahasiswa', 'App\Http\Controllers\MahasiswaController@data');


use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index']);

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MahasiswaController;

use App\Http\Controllers\TahunAkademikController;

// Route untuk modul Tahun Akademik
Route::resource('tahun-akademik', TahunAkademikController::class);

use App\Http\Controllers\RuangKelasController;

// Taruh di bawah route tahun-akademik yang tadi
Route::resource('ruang-kelas', RuangKelasController::class);

Route::resource('mahasiswa', MahasiswaController::class)
    ->except(['show']);

Route::resource('dosen', DosenController::class)
    ->except(['show']);

Route::resource('mata-kuliah', MataKuliahController::class)
    ->except(['show'])
    ->parameters(['mata-kuliah' => 'mataKuliah']);

Route::get('/mahasiswa/{nama}', function ($nama) {
    return 'Nama mahasiswa: ' . $nama;
});

// Auth
use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::middleware('auth', 'role:admin')->group(function () {
//     Route::resource('dosen', DosenController::class)->except(['show']);
//     Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
//     Route::resource('mmata-kuliah', MataKuliahController::class)->except(['show']);
// });

// Perbaiki grup middleware admin menjadi:
Route::middleware('auth', 'role:admin')->group(function () {
    Route::resource('dosen', DosenController::class)->except(['show']);
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);

    // Typo "mmata-kuliah" diperbaiki menjadi "mata-kuliah", dan parameter ditambahkan
    Route::resource('mata-kuliah', MataKuliahController::class)
        ->except(['show'])
        ->parameters(['mata-kuliah' => 'mataKuliah']);
});

Route::middleware('auth', 'role:dosen')->group(function () {
    Route::get('/dosen/kelas', [
        DosenController::class, 'index'
    ])->name('dosen.kelas');
});

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;

Route::get('/dashboard', function () {
    // Hitung semua datanya
    $jumlahMahasiswa = Mahasiswa::count();
    $jumlahDosen = Dosen::count();
    $jumlahMataKuliah = MataKuliah::count();

    return view('dashboard', compact('jumlahMahasiswa', 'jumlahDosen', 'jumlahMataKuliah'));
});