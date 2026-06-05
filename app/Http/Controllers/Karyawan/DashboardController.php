<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Cuti;
use App\Models\IzinKerja;
use App\Models\Karyawan;
use App\Models\Pinjaman;

class DashboardController extends Controller
{
    protected function currentKaryawan()
    {
        if (session('user_role') === 'karyawan' && session('karyawan_id')) {
            return Karyawan::find(session('karyawan_id')) ?: Karyawan::first();
        }

        return Karyawan::first();
    }

    public function index()
    {
        $karyawan = $this->currentKaryawan();

        $totalPinjaman = Pinjaman::where('karyawan_id', $karyawan->id)->count();
        $pinjamanMenunggu = Pinjaman::where('karyawan_id', $karyawan->id)
            ->where('status', 'Menunggu')->count();
        $cutiTerpakai = Cuti::where('karyawan_id', $karyawan->id)
            ->where('status', 'Disetujui')->sum('jumlah_hari');
        $izinMenunggu = IzinKerja::where('karyawan_id', $karyawan->id)
            ->where('status', 'Menunggu')->count();

        return view('karyawan_panel.dashboard', [
            'karyawan' => $karyawan,
            'totalPinjaman' => $totalPinjaman,
            'pinjamanMenunggu' => $pinjamanMenunggu,
            'cutiTerpakai' => $cutiTerpakai,
            'sisaCuti' => max(0, 12 - $cutiTerpakai),
            'izinMenunggu' => $izinMenunggu,
        ]);
    }
}
