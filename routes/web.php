<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BukuController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/logout', function () {
    session()->flush();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // BUKU
    Route::get('/buku', [BukuController::class, 'index'])->name('buku');
    Route::post('/buku/simpan', [BukuController::class, 'store'])->name('buku.simpan');
    Route::post('/buku/update', [BukuController::class, 'update'])->name('buku.update');
    Route::get('/buku/hapus/{id}', [BukuController::class, 'hapus'])->name('buku.hapus');

});


use App\Http\Controllers\Admin\KategoriController;

Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
Route::post('/admin/kategori/store', [KategoriController::class, 'simpan'])->name('admin.kategori.store');
Route::post('/admin/kategori/update', [KategoriController::class, 'update'])->name('admin.kategori.update');
Route::get('/admin/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('admin.kategori.hapus');

use App\Http\Controllers\Admin\AnggotaController;

Route::get('/admin/anggota', [AnggotaController::class, 'index'])->name('admin.anggota');
Route::get('/admin/anggota/suspend/{id}', [AnggotaController::class, 'suspend'])->name('admin.anggota.suspend');
Route::get('/admin/anggota/aktifkan/{id}', [AnggotaController::class, 'aktifkan'])->name('admin.anggota.aktifkan');

use App\Http\Controllers\Admin\PetugasController;

    Route::get('/admin/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::post('/admin/petugas/tambah', [PetugasController::class, 'store'])->name('petugas.store');
    Route::get('/admin/petugas/hapus/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

use App\Http\Controllers\Admin\PeminjamanController;

    Route::get('/admin/peminjaman', [PeminjamanController::class,'index'])->name('peminjaman.index');
    Route::post('/admin/peminjaman/denda', [PeminjamanController::class,'updateDenda'])->name('peminjaman.denda');
    Route::post('/admin/peminjaman/lama', [PeminjamanController::class,'updateLama'])->name('peminjaman.lama');
    Route::get('/admin/peminjaman/kembalikan/{id}', [PeminjamanController::class,'kembalikan'])->name('peminjaman.kembalikan');