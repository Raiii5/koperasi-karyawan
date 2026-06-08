<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_id')) {
            if (session('user_role') === 'admin') {
                return redirect('/admin/dashboard');
            }

            if (session('user_role') === 'karyawan') {
                return redirect('/karyawan/dashboard');
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password tidak valid.',
                ])
                ->withInput();
        }

        if ($user->role === 'karyawan') {
            $karyawan = Karyawan::find($user->karyawan_id);

            if (! $karyawan) {
                return back()
                    ->withErrors([
                        'username' => 'Data karyawan tidak ditemukan. Silakan hubungi admin HRD.',
                    ])
                    ->withInput();
            }

            if ($karyawan->status !== 'Aktif') {
                return back()
                    ->withErrors([
                        'username' => 'Akun Anda sedang dinonaktifkan oleh admin. Silakan hubungi admin HRD untuk mengaktifkan kembali akun Anda.',
                    ])
                    ->withInput();
            }
        }

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role,
            'karyawan_id' => $user->karyawan_id,
        ]);

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/karyawan/dashboard');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}