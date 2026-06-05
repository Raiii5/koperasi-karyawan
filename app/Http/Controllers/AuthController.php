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
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Username atau password tidak valid'])->withInput();
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
