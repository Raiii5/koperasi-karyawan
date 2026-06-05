@extends('layouts.admin')

@section('title', 'Edit Karyawan')
@section('page-title', 'Edit Karyawan')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Edit Karyawan
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Perbarui data profil karyawan. ID Karyawan tidak dapat diubah.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Data karyawan gagal diperbarui.</p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/karyawan/{{ $karyawan->id }}/update" method="POST" class="space-y-6">
            @csrf

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">ID Karyawan</span>
                <input
                    type="text"
                    value="{{ $karyawan->id_karyawan ?? '-' }}"
                    readonly
                    class="mt-2 w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-600 outline-none">
                <p class="mt-2 text-xs text-slate-500">
                    ID Karyawan dibuat otomatis oleh sistem dan tidak bisa diubah.
                </p>
            </label>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Nama Karyawan</span>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $karyawan->nama) }}"
                    required
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
            </label>

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Divisi</span>
                    <input
                        type="text"
                        name="divisi"
                        value="{{ old('divisi', $karyawan->divisi) }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Jabatan</span>
                    <input
                        type="text"
                        name="jabatan"
                        value="{{ old('jabatan', $karyawan->jabatan) }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

            </div>

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">No HP</span>
                    <input
                        type="text"
                        name="no_hp"
                        value="{{ old('no_hp', $karyawan->no_hp) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Status</span>
                    <select
                        name="status"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="Aktif" {{ old('status', $karyawan->status) === 'Aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="Nonaktif" {{ old('status', $karyawan->status) === 'Nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </label>

            </div>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Alamat</span>
                <textarea
                    name="alamat"
                    rows="4"
                    maxlength="255"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('alamat', $karyawan->alamat) }}</textarea>
                <p class="mt-2 text-xs text-slate-500">
                    Maksimal 255 karakter.
                </p>
            </label>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">

                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Simpan Perubahan
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
            Informasi Karyawan
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Data akun login terhubung dengan ID Karyawan ini.
        </p>

        <div class="mt-5 space-y-3">

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">ID Karyawan</p>
                <p class="mt-1 text-lg font-bold text-blue-700">
                    {{ $karyawan->id_karyawan ?? '-' }}
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Password Default</p>
                <p class="mt-1 text-xs text-slate-500">
                    Jika direset, password akan kembali ke format:
                </p>
                <p class="mt-2 rounded-xl bg-white px-3 py-2 text-xs font-semibold text-slate-700">
                    PTMKU#{{ $karyawan->id_karyawan ? substr($karyawan->id_karyawan, -4) : '0000' }}
                </p>
            </div>

            <div class="rounded-2xl bg-amber-50 p-4">
                <p class="text-sm font-semibold text-amber-700">
                    Reset Password
                </p>

                <p class="mt-1 text-xs text-amber-600">
                    Password akan dikembalikan ke format default berdasarkan ID Karyawan.
                </p>

                <p class="mt-3 rounded-xl bg-white px-3 py-2 text-xs font-semibold text-slate-700">
                    PTMKU#{{ $karyawan->id_karyawan ? substr($karyawan->id_karyawan, -4) : '0000' }}
                </p>

                <form
                    action="/admin/karyawan/{{ $karyawan->id }}/reset-password"
                    method="POST"
                    class="mt-4"
                    data-confirm="Password karyawan akan dikembalikan ke format default. Lanjutkan reset password?"
                    data-confirm-title="Reset Password Karyawan"
                    data-confirm-button="Ya, Reset Password"
                    data-confirm-type="danger">

                    @csrf

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-amber-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-amber-600">
                        Reset Password
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection