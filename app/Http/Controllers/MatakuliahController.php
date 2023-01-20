<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    // get all matakuliah
    public function all()
    {
        $matakuliahs = Matakuliah::all();

        // loop through matakuliahs
        foreach ($matakuliahs as $matakuliah) {
            echo "$matakuliah->id | $matakuliah->nama | $matakuliah->jumlah_sks  <br>";
        };
    }

    // attach mahasiswa to matakuliah

    public function attach()
    {
        $matakuliah = Matakuliah::find(4);
        $mahasiswa = Mahasiswa::find(4);
        $matakuliah->mahasiswas()->attach($mahasiswa);

        echo "$matakuliah";
        echo "<hr>";
        echo "$mahasiswa";
    }

    // menghubungkan matakuliah dengan banyak mahaiswa dengan where
    public function attachWhere()
    {
        $matakuliah = Matakuliah::where('nama', 'Pemrograman Web')->first();
        $mahasiswa = Mahasiswa::where('nama', 'like', '%Wani%')->get();
        $matakuliah->mahasiswas()->attach($mahasiswa);

        echo "$matakuliah";
        echo "<hr>";
        echo "$mahasiswa";
    }

    // tampilkan data mahasiswa yang mengambil matakuliah tertentu
    public function tampil()
    {
        $matakuliah = Matakuliah::where('nama', 'Pemrograman Web')->first();

        echo "mahasiswa yang mengambil matakuliah $matakuliah->nama <br>";
        foreach ($matakuliah->mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nama <br>";
        }
    }

    // detach
    public function detach()
    {
        $matakuliah = Matakuliah::find(4);
        $mahasiswa = Mahasiswa::find(4);
        $matakuliah->mahasiswas()->detach($mahasiswa);

        echo "$matakuliah";
        echo "<hr>";
        echo "$mahasiswa";
    }

    // input data dengan sync with array

    public function sync()
    {
        Matakuliah::where('nama', 'Pemrograman Web')->first()->mahasiswas()->sync(Mahasiswa::find([4]));

        echo "sync berhasil";
    }

    // akses tabel pivot
    public function pivot()
    {
        $matakuliah = Matakuliah::where('nama', 'Pemrograman Web')->first();
        dump($matakuliah->mahasiswas);

        foreach ($matakuliah->mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nama ($mahasiswa->jurusan),
 mengambil mata kuliah pada {$mahasiswa->pivot->created_at->isoFormat('D MMMM Y')} <br>";
        }
    }

}
