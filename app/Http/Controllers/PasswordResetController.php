<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function showForm()
    {
        return view('auth.ubah-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'id_karyawan' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'id_karyawan.required' => 'ID Karyawan wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = DB::table('users')
            ->where('username', $request->username)
            ->where('role', 'karyawan')
            ->first();

        if (!$user) {
            return back()
                ->withInput()
                ->withErrors([
                    'username' => 'Username tidak ditemukan.',
                ]);
        }

        $karyawan = Karyawan::find($user->karyawan_id);

        if (!$karyawan) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_karyawan' => 'Data karyawan tidak ditemukan.',
                ]);
        }

        if ($karyawan->id_karyawan !== $request->id_karyawan) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_karyawan' => 'ID Karyawan tidak sesuai dengan username.',
                ]);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password),
                'updated_at' => now(),
            ]);

        return redirect('/login')
            ->with('success', 'Password berhasil diubah. Silakan login menggunakan password baru.');
    }
}