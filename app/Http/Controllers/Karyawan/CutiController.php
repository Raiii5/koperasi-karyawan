<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CutiController extends Controller
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

        $cutis = Cuti::where('karyawan_id', $karyawan->id)
            ->latest()
            ->get();

        return view('karyawan_panel.cuti.index', compact('cutis', 'karyawan'));
    }

    public function create()
    {
        return view('karyawan_panel.cuti.create');
    }

    public function store(Request $request)
    {
        $karyawan = $this->currentKaryawan();

        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ], [
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'alasan.required' => 'Alasan cuti wajib diisi.',
            'alasan.max' => 'Alasan cuti maksimal 255 karakter.',
        ]);

        $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai)->startOfDay();

        /*
         * Sesuai kebutuhan sistem:
         * 08-06 sampai 10-06 = 2 hari
         * 08-06 sampai 21-06 = 13 hari
         *
         * Jika tanggal mulai dan selesai sama, tetap dihitung 1 hari.
         */
        $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai);

        if ($jumlahHari < 1) {
            $jumlahHari = 1;
        }

        if ($jumlahHari > 12) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal_selesai' => 'Pengajuan cuti tidak boleh lebih dari 12 hari. Total hari dari tanggal yang dipilih adalah ' . $jumlahHari . ' hari.',
                ]);
        }

        $tahunPengajuan = $tanggalMulai->year;

        $totalCutiTahunIni = Cuti::where('karyawan_id', $karyawan->id)
            ->whereYear('tanggal_mulai', $tahunPengajuan)
            ->whereIn('status', ['Menunggu', 'Disetujui'])
            ->sum('jumlah_hari');

        $sisaCuti = 12 - $totalCutiTahunIni;

        if ($sisaCuti <= 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal_mulai' => 'Jatah cuti tahun ' . $tahunPengajuan . ' sudah habis. Maksimal cuti adalah 12 hari dalam 1 tahun.',
                ]);
        }

        if (($totalCutiTahunIni + $jumlahHari) > 12) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal_selesai' => 'Pengajuan cuti melebihi batas. Sisa cuti tahun ' . $tahunPengajuan . ' hanya ' . $sisaCuti . ' hari, sedangkan tanggal yang dipilih berjumlah ' . $jumlahHari . ' hari.',
                ]);
        }

        Cuti::create([
            'karyawan_id' => $karyawan->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_hari' => $jumlahHari,
            'alasan' => $request->alasan,
            'status' => 'Menunggu',
        ]);

        return redirect('/karyawan/cuti')
            ->with('success', 'Pengajuan cuti berhasil dikirim dan menunggu persetujuan HRD. Sisa cuti tahun ini: ' . ($sisaCuti - $jumlahHari) . ' hari.');
    }
}