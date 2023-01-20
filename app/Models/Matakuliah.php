<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    // belong to many mahasiswas
    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class)->withTimestamps();
    }
}
