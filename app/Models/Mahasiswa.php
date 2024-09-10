<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $primaryKey = 'nrp';

    // Menentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'nrp',
        'nama',
        'email',
        'photo',
    ];

    public $timestamps = false;

    public function get_all_mahasiswa()
    {
        return self::all(); // Menggunakan Eloquent untuk mengambil semua data
    }
}