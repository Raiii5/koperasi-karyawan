@extends('layouts.karyawan')

@section('title', 'Ubah Password')
@section('page-title', 'Ubah Password')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Ubah Password
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Gunakan password yang mudah diingat namun sulit ditebak.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Password gagal diubah.</p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/karyawan/password" method="POST" class="space-y-6">
            @csrf

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">
                    Password Lama
                </span>

                <input
                    type="password"
                    name="password_lama"
                    required
                    placeholder="Masukkan password lama"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
            </label>

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">
                        Password Baru
                    </span>

                    <input
                        type="password"
                        name="password_baru"
                        required
                        minlength="8"
                        placeholder="Minimal 8 karakter"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">
                        Konfirmasi Password Baru
                    </span>

                    <input
                        type="password"
                        name="password_baru_confirmation"
                        required
                        minlength="8"
                        placeholder="Ulangi password baru"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

            </div>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">

                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Simpan Password
                </button>

                <a
                    href="/karyawan/dashboard"
                    class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>

            </div>

        </form>

    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <h3 class="text-lg font-bold text-slate-900">
            Tips Keamanan
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Segera ubah password default setelah akun dibuat oleh admin.
        </p>

        <div class="mt-5 space-y-3">

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">
                    Minimal 8 Karakter
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Gunakan kombinasi huruf dan angka agar lebih aman.
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">
                    Jangan Bagikan Password
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Password bersifat pribadi dan tidak boleh diberikan ke orang lain.
                </p>
            </div>

            <div class="rounded-2xl bg-blue-50 p-4">
                <p class="text-sm font-semibold text-blue-700">
                    Lupa Password?
                </p>
                <p class="mt-1 text-xs text-blue-600">
                    Hubungi admin HRD untuk melakukan reset password.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection