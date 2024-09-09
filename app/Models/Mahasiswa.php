<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Model
{
    use HasFactory;

    public function get_all_mahasiswa()
    {
        return DB::select("
        SELECT * FROM mahasiswa
        ");
    }
}