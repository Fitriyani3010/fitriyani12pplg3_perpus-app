<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan'; // nama tabel
    protected $primaryKey = 'id_pengaturan';    // primary key
    public $timestamps = false;      // kalau tabel ini nggak ada created_at / updated_at

    protected $fillable = [
        'nama_pengaturan',
        'nilai'
    ];
}