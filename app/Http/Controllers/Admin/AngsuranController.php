<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function index()
    {
        $angsurans = Angsuran::with('pinjaman.karyawan')->latest()->get();

        return view('admin.angsuran.index', compact('angsurans'));
    }

    public function create()
    {
        $pinjamans = Pinjaman::with('karyawan')->where('status', 'Disetujui')->get();

        return view('admin.angsuran.create', compact('pinjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_id' => 'required|exists:pinjamans,id',
            'nominal_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Angsuran::create($request->only([
            'pinjaman_id',
            'nominal_bayar',
            'tanggal_bayar',
            'keterangan',
        ]));

        return redirect('/admin/angsuran');
    }
}
