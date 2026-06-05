<?php

namespace App\Http\Middleware;

use App\Models\Karyawan;
use Closure;
use Illuminate\Http\Request;

class KaryawanAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('user_role')) {
            if (session('user_role') === 'karyawan' && session('karyawan_id')) {
                return $next($request);
            }

            return redirect('/login');
        }

        $firstKaryawan = Karyawan::first();
        if ($firstKaryawan) {
            session([
                'user_id' => 0,
                'user_name' => $firstKaryawan->nama,
                'user_role' => 'karyawan',
                'karyawan_id' => $firstKaryawan->id,
            ]);

            return $next($request);
        }

        return redirect('/login');
    }
}
