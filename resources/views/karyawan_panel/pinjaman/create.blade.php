@extends('layouts.karyawan')

@section('title', 'Ajukan Pinjaman')
@section('page-title', 'Ajukan Pinjaman')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Pengajuan Pinjaman
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Isi nominal, tenor, dan alasan pengajuan pinjaman Anda.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Pengajuan pinjaman gagal dikirim.</p>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/karyawan/pinjaman" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Nominal Pinjaman</span>
                    <input
                        type="number"
                        name="nominal"
                        value="{{ old('nominal') }}"
                        min="1"
                        required
                        placeholder="Contoh: 2000000"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <p class="mt-2 text-xs text-slate-500">
                        Masukkan angka tanpa titik atau koma.
                    </p>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Tenor</span>
                    <input
                        type="number"
                        name="tenor"
                        value="{{ old('tenor') }}"
                        min="1"
                        required
                        placeholder="Contoh: 6"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <p class="mt-2 text-xs text-slate-500">
                        Lama angsuran dalam bulan.
                    </p>
                </label>
            </div>

            <label class="block">
    <span class="text-sm font-semibold text-slate-700">Kesanggupan Bayar per Bulan</span>
    <input
        type="number"
        name="kesanggupan_bayar"
        value="{{ old('kesanggupan_bayar') }}"
        min="1"
        required
        placeholder="Contoh: 1000000"
        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
    <p class="mt-2 text-xs text-slate-500">
        Masukkan nominal kemampuan bayar setiap bulan.
    </p>
        </label>
        
            <label class="block">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-700">Alasan Pinjaman</span>
                    <span id="alasanPinjamanCounter" class="text-xs text-slate-500">
                        {{ strlen(old('alasan', '')) }}/150 karakter
                    </span>
                </div>

                <textarea
                    name="alasan"
                    rows="4"
                    maxlength="150"
                    required
                    oninput="document.getElementById('alasanPinjamanCounter').innerText = this.value.length + '/150 karakter'"
                    placeholder="Tuliskan alasan pengajuan pinjaman secara singkat"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('alasan') }}</textarea>

                <p class="mt-2 text-xs text-slate-500">
                    Maksimal 150 karakter.
                </p>
            </label>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">
                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Ajukan Pinjaman
                </button>

                <a
                    href="/karyawan/pinjaman"
                    class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>
            </div>

        </form>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <h3 class="text-lg font-bold text-slate-900">
            Panduan Pengajuan
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Pastikan nominal dan tenor sesuai kebutuhan sebelum mengirim pengajuan.
        </p>

        <div class="mt-5 space-y-3">
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">1. Isi Nominal</p>
                <p class="mt-1 text-xs text-slate-500">Masukkan jumlah pinjaman yang ingin diajukan.</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">2. Tentukan Tenor</p>
                <p class="mt-1 text-xs text-slate-500">Tenor dihitung dalam jumlah bulan.</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">3. Menunggu HRD</p>
                <p class="mt-1 text-xs text-slate-500">Status akan berubah setelah diproses oleh admin.</p>
            </div>
        </div>

    </div>

</div>

@endsection