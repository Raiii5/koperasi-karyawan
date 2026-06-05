<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjamans = Pinjaman::with('karyawan')->latest()->get();

        return view('admin.pinjaman.index', compact('pinjamans'));
    }

    public function approve($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update([
            'status' => 'Disetujui',
            'catatan_admin' => 'Disetujui oleh admin',
        ]);

        return redirect('/admin/pinjaman');
    }

    public function reject($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update([
            'status' => 'Ditolak',
            'catatan_admin' => 'Ditolak oleh admin',
        ]);

        return redirect('/admin/pinjaman');
    }
}
