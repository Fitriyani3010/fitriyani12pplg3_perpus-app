<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Nama tabel
    protected $table = 'user';

    // Primary key (karena kamu pakai id_user, bukan id)
    protected $primaryKey = 'id_user';

    // Auto increment
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Matikan timestamps (karena tabel kamu tidak ada created_at & updated_at)
    public $timestamps = false;

    // Field yang boleh diisi
    protected $fillable = [
        'username',
        'password',
        'alamat',
        'no_telp',
        'nisn',
        'role',
        'status',
        'foto'
    ];

    // Hidden field
    protected $hidden = [
        'password',
    ];
}