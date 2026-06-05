<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\IzinKerja;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IzinKerjaController extends Controller
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
        $izins = IzinKerja::where('karyawan_id', $karyawan->id)->latest()->get();

        return view('karyawan_panel.izin.index', compact('izins', 'karyawan'));
    }

    public function create()
    {
        return view('karyawan_panel.izin.create');
    }

    public function store(Request $request)
    {
        $karyawan = $this->currentKaryawan();

        $request->validate([
            'jenis_izin' => 'required|string|in:Sakit,Mendesak,Lainnya',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:100',
            'lampiran' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('lampiran_izin', 'public');
        }

        IzinKerja::create([
            'karyawan_id' => $karyawan->id,
            'jenis_izin' => $request->jenis_izin,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'lampiran' => $path,
            'status' => 'Menunggu',
        ]);

        return redirect('/karyawan/izin')
    ->with('success', 'Pengajuan izin berhasil dikirim dan menunggu persetujuan HRD.');
    }
}
