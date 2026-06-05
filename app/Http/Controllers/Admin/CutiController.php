<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;

class CutiController extends Controller
{
    public function index()
    {
        $cutis = Cuti::with('karyawan')->latest()->get();

        return view('admin.cuti.index', compact('cutis'));
    }

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([
            'status' => 'Disetujui',
            'catatan_admin' => 'Cuti disetujui oleh admin',
        ]);

        return redirect('/admin/cuti')
            ->with('success', 'Pengajuan cuti berhasil disetujui.');
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([
            'status' => 'Ditolak',
            'catatan_admin' => 'Cuti ditolak oleh admin',
        ]);

        return redirect('/admin/cuti')
            ->with('success', 'Pengajuan cuti berhasil ditolak.');
    }
}