@extends('layouts.admin')

@section('title', 'Tambah Karyawan')
@section('page-title', 'Tambah Karyawan')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Tambah Karyawan
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Isi data profil karyawan. ID karyawan dan akun login akan dibuat otomatis oleh sistem.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Data karyawan gagal disimpan.</p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/karyawan" method="POST" class="space-y-6">
            @csrf

            <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4">
                <p class="text-sm font-semibold text-blue-700">
                    ID karyawan dibuat otomatis
                </p>
                <p class="mt-1 text-xs text-blue-600">
                    Sistem akan membuat ID Karyawan, username, dan password default setelah data disimpan.
                </p>
            </div>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Nama Karyawan</span>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    required
                    placeholder="Contoh: Akbar Wijaya"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
            </label>

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Divisi</span>
                    <input
                        type="text"
                        name="divisi"
                        value="{{ old('divisi') }}"
                        required
                        placeholder="Contoh: Gudang"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Jabatan</span>
                    <input
                        type="text"
                        name="jabatan"
                        value="{{ old('jabatan') }}"
                        required
                        placeholder="Contoh: Operator"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

            </div>

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">No HP</span>
                    <input
                        type="text"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 081234567890"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-700">
                        Status Awal
                    </p>
                    <p class="mt-1 text-2xl font-bold text-emerald-600">
                        Aktif
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Karyawan baru otomatis berstatus aktif.
                    </p>
                </div>

            </div>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Alamat</span>
                <textarea
                    name="alamat"
                    rows="4"
                    maxlength="255"
                    placeholder="Masukkan alamat karyawan"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('alamat') }}</textarea>
                <p class="mt-2 text-xs text-slate-500">
                    Maksimal 255 karakter.
                </p>
            </label>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">

                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Simpan Karyawan
                </button>

                <a
                    href="/admin/karyawan"
                    class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>

            </div>

        </form>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <h3 class="text-lg font-bold text-slate-900">
            Informasi Akun Login
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Setelah data karyawan disimpan, sistem otomatis membuat akun login.
        </p>

        <div class="mt-5 space-y-3">

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Username</p>
                <p class="mt-1 text-xs text-slate-500">
                    Dibuat dari nama karyawan.
                </p>
                <p class="mt-2 rounded-xl bg-white px-3 py-2 text-xs font-semibold text-slate-700">
                    Contoh: akbar.wijaya
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Password Default</p>
                <p class="mt-1 text-xs text-slate-500">
                    Format password dari 4 digit akhir ID karyawan.
                </p>
                <p class="mt-2 rounded-xl bg-white px-3 py-2 text-xs font-semibold text-slate-700">
                    Contoh: PTMKU#4455
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Keamanan</p>
                <p class="mt-1 text-xs text-slate-500">
                    Karyawan disarankan mengganti password setelah login pertama.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection