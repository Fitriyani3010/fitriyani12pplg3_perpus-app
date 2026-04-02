<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\PeminjamanController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // BUKU ADMIN
    Route::get('/buku', [AdminBukuController::class, 'index'])->name('buku');
    Route::post('/buku/simpan', [AdminBukuController::class, 'store'])->name('buku.simpan');
    Route::post('/buku/update', [AdminBukuController::class, 'update'])->name('buku.update');
    Route::get('/buku/hapus/{id}', [AdminBukuController::class, 'hapus'])->name('buku.hapus');

    // KATEGORI
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/store', [KategoriController::class, 'simpan'])->name('kategori.store');
    Route::post('/kategori/update', [KategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');

    // ANGGOTA
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
    Route::get('/anggota/suspend/{id}', [AnggotaController::class, 'suspend'])->name('anggota.suspend');
    Route::get('/anggota/aktifkan/{id}', [AnggotaController::class, 'aktifkan'])->name('anggota.aktifkan');

    // PETUGAS
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::post('/petugas/tambah', [PetugasController::class, 'store'])->name('petugas.store');
    Route::get('/petugas/hapus/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

    // PEMINJAMAN
    Route::get('/peminjaman', [PeminjamanController::class,'index'])->name('peminjaman.index');
    Route::post('/peminjaman/denda', [PeminjamanController::class,'updateDenda'])->name('peminjaman.denda');
    Route::post('/peminjaman/lama', [PeminjamanController::class,'updateLama'])->name('peminjaman.lama');
    Route::get('/peminjaman/kembalikan/{id}', [PeminjamanController::class,'kembalikan'])->name('peminjaman.kembalikan');

});


/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;
use App\Http\Controllers\Petugas\AnggotaController as PetugasAnggotaController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\KategoriController as PetugasKategoriController;

Route::prefix('petugas')->name('petugas.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [PetugasDashboardController::class,'index'])->name('dashboard');

    // BUKU
    Route::get('/buku', [PetugasBukuController::class, 'index'])->name('buku.index');
    Route::post('/buku/store', [PetugasBukuController::class, 'store'])->name('buku.store');
    Route::post('/buku/update', [PetugasBukuController::class, 'update'])->name('buku.update');
    Route::get('/buku/hapus/{id}', [PetugasBukuController::class, 'destroy'])->name('buku.destroy');

    // ANGGOTA (FIX DI SINI)
    Route::get('/Anggota', [PetugasAnggotaController::class, 'index'])->name('anggota');
    Route::get('/Anggota/suspend/{id}', [PetugasAnggotaController::class, 'suspend'])->name('anggota.suspend');
    Route::get('/Anggota/aktifkan/{id}', [PetugasAnggotaController::class, 'aktifkan'])->name('anggota.aktifkan');

    Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])
        ->name('peminjaman');

    Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])->name('petugas.pengembalian');

Route::get('/pengembalian/konfirmasi/{id}', [PetugasPengembalianController::class, 'konfirmasi'])->name('petugas.pengembalian.konfirmasi');

Route::get('/pengembalian/tolak/{id}', [PetugasPengembalianController::class, 'tolak'])->name('petugas.pengembalian.tolak');

Route::get('/kategori', [PetugasKategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/store', [PetugasKategoriController::class, 'simpan'])->name('kategori.store');
    Route::post('/kategori/update', [PetugasKategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategori/hapus/{id}', [PetugasKategoriController::class, 'hapus'])->name('kategori.hapus');
});

use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;

Route::get('/anggota/dashboard', [AnggotaDashboardController::class, 'index'])
    ->name('anggota.dashboard');

    use App\Http\Controllers\Anggota\BukuController as AnggotaBukuController;

Route::get('/anggota/buku', [AnggotaBukuController::class, 'index'])
    ->name('anggota.buku');