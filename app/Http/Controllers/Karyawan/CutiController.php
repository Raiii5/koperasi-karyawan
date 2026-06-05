<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;

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
        $cutis = Cuti::where('karyawan_id', $karyawan->id)->latest()->get();

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
            'jumlah_hari' => 'required|integer|min:1',
            'alasan' => 'required|string|max:255',
        ]);

        Cuti::create([
            'karyawan_id' => $karyawan->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_hari' => $request->jumlah_hari,
            'alasan' => $request->alasan,
            'status' => 'Menunggu',
        ]);

        return redirect('/karyawan/cuti')
    ->with('success', 'Pengajuan cuti berhasil dikirim dan menunggu persetujuan HRD.');
    }
}
