<?php

namespace App\Models;

use App\Models\Angsuran;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';

    protected $fillable = [
        'karyawan_id',
        'nominal',
        'tenor',
        'kesanggupan_bayar',
        'alasan',
        'status',
        'catatan_admin',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function angsurans()
{
    return $this->hasMany(Angsuran::class);
}
}