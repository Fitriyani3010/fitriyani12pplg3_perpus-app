<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

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

    protected $hidden = [
        'password',
    ];
}