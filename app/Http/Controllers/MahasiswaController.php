<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class MahasiswaController extends Controller
{
    // all mahasiswa and loop each
    public function all(){
        $mahasiswas = Mahasiswa::all();
        foreach($mahasiswas as $mahasiswa){
            echo "$mahasiswa->id |$mahasiswa->nim | ";
            echo "$mahasiswa->nama | $mahasiswa->jurusan <br>";
        }
    }

    // input data relationship
    public function attach(){
        $mahasiswa = Mahasiswa::find(1);
        $matakuliah = Matakuliah::find(1);

        // proses attach, hubungkan mahasiswa dengan matakuliah
        $mahasiswa->matakuliahs()->attach($matakuliah);

//        echo '<br>';
        echo ($mahasiswa);
        echo '<br>';

        echo ($matakuliah);
    }

    // attach dengan array
    public function attachArray(){
        $mahasiswa = Mahasiswa::find(1);
        $matakuliah = Matakuliah::find([4,2,3]);

        // proses attach, hubungkan mahasiswa dengan matakuliah
        $mahasiswa->matakuliahs()->attach($matakuliah);

        echo ($mahasiswa);
        echo '<br>';

        echo ($matakuliah);
    }

    // attach dengan where
    public function attachWhere(){
        $mahasiswa = Mahasiswa::find(2);
        $matakuliah = Matakuliah::where('jumlah_sks', '>=', 3)->get();

        // proses attach, hubungkan mahasiswa dengan matakuliah
        $mahasiswa->matakuliahs()->attach($matakuliah);

        echo ($mahasiswa);
        echo '<br>';

        echo ($matakuliah);
    }

    // tampil data relationship\
    public function tampil(){
        $mahasiswa = Mahasiswa::find(1);

        echo $mahasiswa->nama;
        echo '<hr>';
        foreach($mahasiswa->matakuliahs as $matakuliah){
            echo "$matakuliah->id | $matakuliah->nama | $matakuliah->jumlah_sks <br>";
        }
    }

    //menghitung data dengan withcount
    public function relationshipCount(){
        $mahasiswa = Mahasiswa::withCount('matakuliahs')->get();
        foreach ($mahasiswa as $mhs){
            echo "$mhs->nama | $mhs->matakuliahs_count <br>";
        }
    }

    // detach menghapus data relationship
    public function detach(){
        $mahasiswa = Mahasiswa::find(1);
        $matakuliah = Matakuliah::find(1);

        // proses detach, hapus hubungan mahasiswa dengan matakuliah
        $mahasiswa->matakuliahs()->detach($matakuliah);

        echo "mahasiswa" . ($mahasiswa);
        echo '<br>';

        echo "matakuliah" . ($matakuliah);
    }

    // sync untuk menghapus dan menambahkan data menghindari data ganda dari metode attach(solusi attach adalah memberikan unique id ke table mahasisa_matakuliah
    public function sync(){
        $mahasiswa = Mahasiswa::find(1);
        $matakuliah = Matakuliah::find([1,2,3]);

        // proses sync, hapus dan tambah hubungan mahasiswa dengan matakuliah
        $mahasiswa->matakuliahs()->sync($matakuliah);

        echo "proses sync berhasil<br>";
        echo "mahasiswa" . ($mahasiswa);
        echo '<br>';

        echo "matakuliah" . ($matakuliah);
    }

    // chaining with sync
    public function syncChaining(){
        $mahasiswa = Mahasiswa::find(10)->matakuliahs()->sync(Matakuliah::find([1,2,3]));

        echo "proses sync berhasil<br>";
        dump($mahasiswa);
    }

    // sync without detaching
    public function syncWithout(){
        $mahasiswa = Mahasiswa::find(1);
        $matakuliah = Matakuliah::find([4,5]);

        // proses sync, hapus dan tambah hubungan mahasiswa dengan matakuliah
        $mahasiswa->matakuliahs()->syncWithoutDetaching($matakuliah);

        echo "proses sync without detaching berhasil<br>";
        echo "mahasiswa" . ($mahasiswa);
        echo '<br>';

        echo "matakuliah" . ($matakuliah);
    }

    // toggle
    public function toggle(){
        $mahasiswa = Mahasiswa::find(1);
        $matakuliah = Matakuliah::find([1]);

        // proses toggle, hapus dan tambah hubungan mahasiswa dengan matakuliah
        $mahasiswa->matakuliahs()->toggle($matakuliah);

        echo "proses toggle berhasil<br>";
        echo "mahasiswa" . ($mahasiswa);
        echo '<br>';

        echo "matakuliah" . ($matakuliah);
    }

    // delete mahasiswa
    public function delete(){
        $mahasiswa = Mahasiswa::find(1);
        $mahasiswa->delete();

        echo "proses delete berhasil<br>";
        echo "mahasiswa" . ($mahasiswa);
    }
}
