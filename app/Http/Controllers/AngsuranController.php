<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function index()
    {
        $angsurans = Angsuran::with('pinjaman.karyawan')->latest()->get();

        return view('angsuran.index', compact('angsurans'));
    }

    public function create()
    {
        $pinjamans = Pinjaman::with('karyawan')
            ->where('status', 'Disetujui')
            ->get();

        return view('angsuran.create', compact('pinjamans'));
    }

    public function store(Request $request)
    {
        Angsuran::create([
            'pinjaman_id' => $request->pinjaman_id,
            'nominal_bayar' => $request->nominal_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/angsuran');
    }
}