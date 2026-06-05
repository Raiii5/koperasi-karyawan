<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
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
        $pinjamans = Pinjaman::where('karyawan_id', $karyawan->id)->latest()->get();

        return view('karyawan_panel.pinjaman.index', compact('pinjamans', 'karyawan'));
    }

    public function create()
    {
        return view('karyawan_panel.pinjaman.create');
    }

    public function store(Request $request)
    {
        $karyawan = $this->currentKaryawan();

        $request->validate([
    'nominal' => 'required|numeric|min:1',
    'tenor' => 'required|numeric|min:1',
    'kesanggupan_bayar' => 'required|numeric|min:1',
    'alasan' => 'required|string|max:150',
]);

        Pinjaman::create([
            'karyawan_id' => $karyawan->id,
            'nominal' => $request->nominal,
            'tenor' => $request->tenor,
            'kesanggupan_bayar' => $request->kesanggupan_bayar,
            'alasan' => $request->alasan,
            'status' => 'Menunggu',
        ]);

        return redirect('/karyawan/pinjaman');
    }
}
