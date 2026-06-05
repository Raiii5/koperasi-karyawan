@extends('layouts.admin')

@section('title', 'Input Angsuran')
@section('page-title', 'Input Angsuran')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Input Angsuran
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Catat pembayaran angsuran pinjaman karyawan.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Data angsuran gagal disimpan.</p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/angsuran" method="POST" class="space-y-6">
            @csrf

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">
                    Pilih Pinjaman
                </span>

                <select
                    name="pinjaman_id"
                    required
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <option value="">Pilih pinjaman karyawan</option>

                    @foreach ($pinjamans as $pinjaman)
                        <option value="{{ $pinjaman->id }}" {{ old('pinjaman_id') == $pinjaman->id ? 'selected' : '' }}>
                            {{ $pinjaman->karyawan->nama ?? '-' }}
                            • Rp {{ number_format($pinjaman->nominal ?? 0, 0, ',', '.') }}
                            • {{ $pinjaman->status }}
                        </option>
                    @endforeach
                </select>
            </label>

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">
                        Nominal Bayar
                    </span>

                    <input
                        type="number"
                        name="nominal_bayar"
                        value="{{ old('nominal_bayar') }}"
                        required
                        min="1"
                        placeholder="Contoh: 500000"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">
                        Tanggal Bayar
                    </span>

                    <input
                        type="date"
                        name="tanggal_bayar"
                        value="{{ old('tanggal_bayar') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

            </div>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">
                    Keterangan
                </span>

                <textarea
                    name="keterangan"
                    rows="4"
                    maxlength="150"
                    placeholder="Contoh: Angsuran bulan pertama"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('keterangan') }}</textarea>

                <p class="mt-2 text-xs text-slate-400">
                    Maksimal 150 karakter.
                </p>
            </label>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">

                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Simpan Angsuran
                </button>

                <a
                    href="/admin/angsuran"
                    class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>

            </div>
        </form>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <h3 class="text-lg font-bold text-slate-900">
            Panduan Input
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Pilih pinjaman yang sudah disetujui, lalu masukkan nominal pembayaran angsuran sesuai transaksi karyawan.
        </p>

        <div class="mt-5 space-y-3">

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">
                    1. Pilih Pinjaman
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Pastikan nama karyawan dan nominal pinjaman sudah sesuai.
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">
                    2. Isi Nominal Bayar
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Masukkan nominal angka tanpa titik atau koma.
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">
                    3. Simpan Data
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Data akan muncul di halaman Data Angsuran setelah disimpan.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection