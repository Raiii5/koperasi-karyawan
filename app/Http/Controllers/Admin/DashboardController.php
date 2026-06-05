<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Pinjaman;
use App\Models\Cuti;
use App\Models\IzinKerja;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();

        $pinjamanMenunggu = Pinjaman::where('status', 'Menunggu')->count();
        $cutiMenunggu = Cuti::where('status', 'Menunggu')->count();
        $izinMenunggu = IzinKerja::where('status', 'Menunggu')->count();

        $pinjamanDisetujui = Pinjaman::where('status', 'Disetujui')->count();

        $cutiBulanIni = Cuti::whereMonth('created_at', now()->month)->count();
        $izinBulanIni = IzinKerja::whereMonth('created_at', now()->month)->count();

        $pinjamanTerbaru = Pinjaman::with('karyawan')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->karyawan->nama ?? '-',
                    'jenis' => 'Pengajuan Pinjaman',
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            });

        $cutiTerbaru = Cuti::with('karyawan')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->karyawan->nama ?? '-',
                    'jenis' => 'Pengajuan Cuti',
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            });

        $izinTerbaru = IzinKerja::with('karyawan')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->karyawan->nama ?? '-',
                    'jenis' => 'Pengajuan Izin Kerja',
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            });

        $aktivitasTerbaru = $pinjamanTerbaru
            ->merge($cutiTerbaru)
            ->merge($izinTerbaru)
            ->sortByDesc('tanggal')
            ->take(6);

        return view('admin.dashboard', compact(
            'totalKaryawan',
            'pinjamanMenunggu',
            'cutiMenunggu',
            'izinMenunggu',
            'pinjamanDisetujui',
            'cutiBulanIni',
            'izinBulanIni',
            'aktivitasTerbaru'
        ));
    }
}