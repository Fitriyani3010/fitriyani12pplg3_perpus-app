<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';       // nama tabel
    protected $primaryKey = 'id_buku';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'id_kategori', // jika ada kategori
        'stok',
        'pengarang',
        'penerbit',
        'tahun_terbit',
    ];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku', 'id_buku');
    }
}