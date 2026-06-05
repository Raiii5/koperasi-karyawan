<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Pinjaman;
use App\Models\Cuti;
use App\Models\IzinKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KaryawanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $karyawans = Karyawan::query()
        ->when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('id_karyawan', 'like', "%{$search}%");
        })
        ->orderBy('nama', 'asc')
        ->get();

    return view('admin.karyawan.index', compact(
        'karyawans',
        'search'
    ));
}

    public function create()
    {
        return view('admin.karyawan.create');
    }

    private function generateIdKaryawan()
    {
        do {
            /*
             * Format ID otomatis:
             * Tahun + bulan + 4 angka random
             * Contoh: 2026064455
             */
            $idKaryawan = now()->format('Ym') . rand(1000, 9999);
        } while (Karyawan::where('id_karyawan', $idKaryawan)->exists());

        return $idKaryawan;
    }

    private function generateUsername($nama)
    {
        $baseUsername = Str::slug($nama, '.');

        if (!$baseUsername) {
            $baseUsername = 'karyawan';
        }

        $username = $baseUsername;
        $counter = 1;

        while (DB::table('users')->where('username', $username)->exists()) {
            $username = $baseUsername . '.' . $counter;
            $counter++;
        }

        return $username;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'nullable|string|max:50',
            'nama' => 'required|string|max:150',
            'divisi' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:255',
        ]);

        $loginUsername = null;
        $defaultPassword = null;
        $idKaryawan = null;

        DB::transaction(function () use ($request, &$loginUsername, &$defaultPassword, &$idKaryawan) {

            $idKaryawan = $this->generateIdKaryawan();

            /*
             * Password default:
             * PTMKU# + 4 digit terakhir id_karyawan
             * Contoh id_karyawan 2026064455
             * Password: PTMKU#4455
             */
            $lastFourDigits = substr($idKaryawan, -4);
            $defaultPassword = 'PTMKU#' . $lastFourDigits;

            $karyawan = Karyawan::create([
                'id_karyawan' => $idKaryawan,
                'nik' => $idKaryawan,
                'nama' => $request->nama,
                'divisi' => $request->divisi,
                'jabatan' => $request->jabatan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'status' => 'Aktif',
            ]);

            $loginUsername = $this->generateUsername($karyawan->nama);

            DB::table('users')->insert([
                'name' => $karyawan->nama,
                'email' => $loginUsername . '@mku.local',
                'username' => $loginUsername,
                'role' => 'karyawan',
                'password' => Hash::make($defaultPassword),
                'karyawan_id' => $karyawan->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return redirect('/admin/karyawan')
            ->with(
                'success',
                'Data karyawan berhasil ditambahkan. ID Karyawan: ' . $idKaryawan .
                ' | Username: ' . $loginUsername .
                ' | Password default: ' . $defaultPassword
            );
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $pinjamans = Pinjaman::where('karyawan_id', $id)
            ->latest()
            ->get();

        $cutis = Cuti::where('karyawan_id', $id)
            ->latest()
            ->get();

        $izins = IzinKerja::where('karyawan_id', $id)
            ->latest()
            ->get();

        return view('admin.karyawan.show', compact(
            'karyawan',
            'pinjamans',
            'cutis',
            'izins'
        ));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nik' => 'nullable|string|max:50',
            'nama' => 'required|string|max:150',
            'divisi' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:255',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        $karyawan->update([
        'nik' => $karyawan->nik ?? $karyawan->id_karyawan,
        'nama' => $request->nama,
        'divisi' => $request->divisi,
        'jabatan' => $request->jabatan,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
        'status' => $request->status,   
        ]);

        return redirect('/admin/karyawan')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $karyawan->update([
            'status' => $karyawan->status === 'Aktif' ? 'Nonaktif' : 'Aktif',
        ]);

        return redirect('/admin/karyawan')
            ->with('success', 'Status karyawan berhasil diperbarui.');
    }

    public function resetPassword($id)
{
    $karyawan = Karyawan::findOrFail($id);

    if (!$karyawan->id_karyawan) {
        $newIdKaryawan = $this->generateIdKaryawan();

        $karyawan->update([
            'id_karyawan' => $newIdKaryawan,
            'nik' => $karyawan->nik ?? $newIdKaryawan,
        ]);
    }

    $lastFourDigits = substr($karyawan->id_karyawan, -4);
    $defaultPassword = 'PTMKU#' . $lastFourDigits;

    $user = DB::table('users')
        ->where('karyawan_id', $karyawan->id)
        ->first();

    if ($user) {
        DB::table('users')
            ->where('karyawan_id', $karyawan->id)
            ->update([
                'name' => $karyawan->nama,
                'password' => Hash::make($defaultPassword),
                'updated_at' => now(),
            ]);

        $username = $user->username;
    } else {
        $username = $this->generateUsername($karyawan->nama);

        DB::table('users')->insert([
            'name' => $karyawan->nama,
            'email' => $username . '@mku.local',
            'username' => $username,
            'role' => 'karyawan',
            'password' => Hash::make($defaultPassword),
            'karyawan_id' => $karyawan->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect('/admin/karyawan/' . $karyawan->id . '/edit')
        ->with(
            'success',
            'Password berhasil direset. Username: ' . $username . ' | Password default: ' . $defaultPassword
        );
}
}