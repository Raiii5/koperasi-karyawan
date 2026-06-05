@extends('layouts.auth')

@section('title', 'Ubah Password - PT Multi Karya Usaha')

@section('content')

<div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/70">

    <div class="mb-8 text-center">

        <img
            src="{{ asset('images/mku-logo.png') }}"
            alt="PT Multi Karya Usaha"
            class="mx-auto mb-4 h-24 w-auto object-contain">

        <h1 class="text-2xl font-bold text-slate-900">
            Ubah Password
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Masukkan username dan ID Karyawan untuk membuat password baru.
        </p>

    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="font-semibold">Password gagal diubah.</p>

            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/ubah-password" method="POST" class="space-y-5">

        @csrf

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">
                Username
            </label>

            <input
                type="text"
                name="username"
                value="{{ old('username') }}"
                required
                placeholder="Contoh: adit.subiyatno"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none ring-2 ring-transparent transition focus:border-blue-500 focus:ring-blue-200">
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">
                ID Karyawan
            </label>

            <input
                type="text"
                name="id_karyawan"
                value="{{ old('id_karyawan') }}"
                required
                placeholder="Contoh: 2026069932"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none ring-2 ring-transparent transition focus:border-blue-500 focus:ring-blue-200">
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">
                Password Baru
            </label>

            <input
                type="password"
                name="password"
                required
                minlength="8"
                placeholder="Minimal 8 karakter"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none ring-2 ring-transparent transition focus:border-blue-500 focus:ring-blue-200">
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">
                Konfirmasi Password Baru
            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                minlength="8"
                placeholder="Ulangi password baru"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none ring-2 ring-transparent transition focus:border-blue-500 focus:ring-blue-200">
        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
            Simpan Password Baru
        </button>

    </form>

    <div class="mt-5 text-center">
        <a href="/login" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
            Kembali ke Login
        </a>
    </div>

</div>

@endsection