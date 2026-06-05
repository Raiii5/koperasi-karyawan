<?php

namespace App\Models;

use App\Models\Cuti;
use App\Models\IzinKerja;
use App\Models\Pinjaman;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'id_karyawan',
        'nik',
        'nama',
        'divisi',
        'jabatan',
        'no_hp',
        'alamat',
        'status',
    ];

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class);
    }

    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }

    public function izinKerjas()
    {
        return $this->hasMany(IzinKerja::class);
    }
}


