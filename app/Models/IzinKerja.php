<?php

namespace App\Models;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;

class IzinKerja extends Model
{
    protected $fillable = [
        'karyawan_id',
        'jenis_izin',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'lampiran',
        'status',
        'catatan_admin',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
