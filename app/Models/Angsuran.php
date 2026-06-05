<?php

namespace App\Models;

use App\Models\Pinjaman;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $fillable = [
        'pinjaman_id',
        'nominal_bayar',
        'tanggal_bayar',
        'keterangan',
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}