<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // belong to many matakuliahs
    public function matakuliahs()
    {
        return $this->belongsToMany(Matakuliah::class)->withTimestamps();
    }
}
