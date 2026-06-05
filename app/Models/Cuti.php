<?php

namespace App\Models;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $fillable = [
        'karyawan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_hari',
        'alasan',
        'status',
        'catatan_admin',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
