@extends('layouts.auth')

@section('title', 'Login - PT Multi Karya Usaha')

@section('content')

<div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/70">

    <!-- Logo -->
    <div class="mb-8 text-center">

        <img
            src="{{ asset('images/mku-logo.png') }}"
            alt="PT Multi Karya Usaha"
            class="mx-auto mb-4 h-28 w-auto object-contain">

        <h1 class="text-2xl font-bold text-slate-900">
            PT Multi Karya Usaha
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Portal Karyawan & Koperasi Perusahaan
        </p>

    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('success'))
    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700">
        {{ session('success') }}
    </div>
    @endif

    <form action="/login" method="POST" class="space-y-5">

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
                placeholder="Masukkan username"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none ring-2 ring-transparent transition focus:border-blue-500 focus:ring-blue-200">
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                placeholder="Masukkan password"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none ring-2 ring-transparent transition focus:border-blue-500 focus:ring-blue-200">
        </div>

        <div class="text-right">
        <a href="/ubah-password" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
            Lupa / Ubah Password?
        </a>
        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">

            Masuk ke Sistem

        </button>

    </form>

    <!-- Demo Account -->
    <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4">

        <p class="mb-3 font-semibold text-slate-900">
            Akun Demo
        </p>

        <div class="space-y-2 text-sm text-slate-600">

            <div class="flex items-center justify-between rounded-xl bg-white px-3 py-2">
                <span>Admin</span>
                <span class="font-semibold text-slate-900">
                    admin / admin123
                </span>
            </div>

            <div class="flex items-center justify-between rounded-xl bg-white px-3 py-2">
                <span>Karyawan</span>
                <span class="font-semibold text-slate-900">
                    Nama Karyawan / Nama karyawan123
                </span>
            </div>

        </div>

    </div>

</div>

@endsection