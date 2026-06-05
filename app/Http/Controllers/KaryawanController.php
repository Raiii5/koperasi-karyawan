<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::latest()->get();

        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        Karyawan::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'divisi' => $request->divisi,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status' => 'Aktif',
        ]);

        return redirect('/karyawan');
    }
}