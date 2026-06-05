<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IzinKerja;

class IzinKerjaController extends Controller
{
    public function index()
    {
        $izins = IzinKerja::with('karyawan')->latest()->get();

        return view('admin.izin.index', compact('izins'));
    }

    public function approve($id)
    {
        $izin = IzinKerja::findOrFail($id);
        $izin->update([
            'status' => 'Disetujui',
            'catatan_admin' => 'Izin disetujui oleh admin',
        ]);

        return redirect('/admin/izin')
    ->with('success', 'Pengajuan izin berhasil disetujui.');
    }

    public function reject($id)
    {
        $izin = IzinKerja::findOrFail($id);
        $izin->update([
            'status' => 'Ditolak',
            'catatan_admin' => 'Izin ditolak oleh admin',
        ]);

        return redirect('/admin/izin')
    ->with('success', 'Pengajuan izin berhasil ditolak.');
    }
}
