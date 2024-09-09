<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Menyebutkan kolom primary key
    protected $primaryKey = 'id_user';

    // Menonaktifkan auto-increment untuk primary key
    public $incrementing = false;

    // Menyebutkan tipe dari primary key
    protected $keyType = 'string';

    // Menyebutkan kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'username',
        'password',
    ];

    // Menyembunyikan kolom-kolom tertentu dari hasil serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mengatur pengolahan tipe data tertentu
    protected $casts = [
        'password' => 'hashed', // Untuk menyimpan password yang sudah di-hash
    ];
}
