@extends('layouts.karyawan')

@section('title', 'Ajukan Cuti')
@section('page-title', 'Ajukan Cuti')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Pengajuan Cuti
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Isi periode cuti, jumlah hari, dan alasan pengajuan cuti.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Pengajuan cuti gagal dikirim.</p>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/karyawan/cuti" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Tanggal Mulai</span>
                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="{{ old('tanggal_mulai') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Tanggal Selesai</span>
                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="{{ old('tanggal_selesai') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

            </div>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Jumlah Hari</span>
                <input
                    type="number"
                    name="jumlah_hari"
                    value="{{ old('jumlah_hari') }}"
                    min="1"
                    required
                    placeholder="Contoh: 1"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                <p class="mt-2 text-xs text-slate-500">
                    Masukkan jumlah hari cuti yang diajukan.
                </p>
            </label>

            <label class="block">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-700">Alasan Cuti</span>
                    <span id="alasanCutiCounter" class="text-xs text-slate-500">
                        {{ strlen(old('alasan', '')) }}/150 karakter
                    </span>
                </div>

                <textarea
                    name="alasan"
                    rows="4"
                    maxlength="150"
                    required
                    oninput="document.getElementById('alasanCutiCounter').innerText = this.value.length + '/150 karakter'"
                    placeholder="Tuliskan alasan cuti secara singkat"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('alasan') }}</textarea>

                <p class="mt-2 text-xs text-slate-500">
                    Maksimal 150 karakter.
                </p>
            </label>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">
                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Ajukan Cuti
                </button>

                <a
                    href="/karyawan/cuti"
                    class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>
            </div>

        </form>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <h3 class="text-lg font-bold text-slate-900">
            Informasi Cuti
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Pengajuan cuti akan mengurangi sisa cuti setelah disetujui oleh HRD.
        </p>

        <div class="mt-5 space-y-3">
            <div class="rounded-2xl bg-blue-50 p-4">
                <p class="text-sm font-semibold text-blue-700">Sisa Cuti</p>
                <p class="mt-1 text-2xl font-bold text-blue-800">
                    {{ $sisaCuti ?? 12 }} Hari
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Status Awal</p>
                <p class="mt-1 text-xs text-slate-500">Setiap pengajuan baru akan berstatus Menunggu.</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Persetujuan HRD</p>
                <p class="mt-1 text-xs text-slate-500">Sisa cuti hanya berkurang jika pengajuan disetujui.</p>
            </div>
        </div>

    </div>

</div>

@endsection