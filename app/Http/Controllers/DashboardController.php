<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Pinjaman;
use App\Models\Cuti;
use App\Models\IzinKerja;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::find(session('karyawan_id'));

        if (!$karyawan) {
            return redirect('/login');
        }

        $jatahCuti = 12;

        $cutiTerpakai = Cuti::where('karyawan_id', $karyawan->id)
            ->where('status', 'Disetujui')
            ->sum('jumlah_hari');

        $sisaCuti = $jatahCuti - $cutiTerpakai;

        $totalPinjaman = Pinjaman::where('karyawan_id', $karyawan->id)->count();

        $pinjamanMenunggu = Pinjaman::where('karyawan_id', $karyawan->id)
            ->where('status', 'Menunggu')
            ->count();

        $izinMenunggu = IzinKerja::where('karyawan_id', $karyawan->id)
            ->where('status', 'Menunggu')
            ->count();

        $pinjamanTerbaru = Pinjaman::where('karyawan_id', $karyawan->id)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'jenis' => 'Pengajuan Pinjaman',
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            });

        $cutiTerbaru = Cuti::where('karyawan_id', $karyawan->id)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'jenis' => 'Pengajuan Cuti',
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            });

        $izinTerbaru = IzinKerja::where('karyawan_id', $karyawan->id)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'jenis' => 'Pengajuan Izin Kerja',
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            });

        $aktivitasSaya = $pinjamanTerbaru
            ->merge($cutiTerbaru)
            ->merge($izinTerbaru)
            ->sortByDesc('tanggal')
            ->take(6);

        return view('karyawan_panel.dashboard', compact(
            'karyawan',
            'jatahCuti',
            'cutiTerpakai',
            'sisaCuti',
            'totalPinjaman',
            'pinjamanMenunggu',
            'izinMenunggu',
            'aktivitasSaya'
        ));
    }
}