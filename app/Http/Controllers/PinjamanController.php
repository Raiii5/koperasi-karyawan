<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
{
    $pinjamans = Pinjaman::with('karyawan')->latest()->get();

    return view('pinjaman.index', compact('pinjamans'));
}

    public function create()
    {
        $karyawans = Karyawan::where('status', 'Aktif')->get();

        return view('pinjaman.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        Pinjaman::create([
            'karyawan_id' => $request->karyawan_id,
            'nominal' => $request->nominal,
            'tenor' => $request->tenor,
            'alasan' => $request->alasan,
            'status' => 'Menunggu',
        ]);

        return redirect('/pinjaman');
    }

    public function approve($id)
{
    $pinjaman = Pinjaman::findOrFail($id);
    $pinjaman->update([
        'status' => 'Disetujui',
        'catatan_admin' => 'Pengajuan disetujui oleh admin/HRD',
    ]);

    return redirect('/pinjaman');
}

public function reject($id)
{
    $pinjaman = Pinjaman::findOrFail($id);
    $pinjaman->update([
        'status' => 'Ditolak',
        'catatan_admin' => 'Pengajuan ditolak oleh admin/HRD',
    ]);

    return redirect('/pinjaman');
}
}