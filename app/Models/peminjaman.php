<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';        // nama tabel
    protected $primaryKey = 'id_peminjaman'; // primary key tabel
    public $timestamps = false;             // jika tidak ada created_at / updated_at

    protected $fillable = [
        'id_user',
        'id_buku',
        'jumlah',
        'tgl_peminjaman',
        'tenggat_waktu',
        'status',
    ];

    /**
     * Relasi ke User (anggota/petugas)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke Buku
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    /**
     * Relasi ke Pengembalian
     */
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_peminjaman', 'id_peminjaman');
    }
}