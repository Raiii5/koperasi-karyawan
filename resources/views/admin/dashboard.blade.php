@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard HRD')

@section('content')

@php
    $totalMenunggu = ($pinjamanMenunggu ?? 0) + ($cutiMenunggu ?? 0) + ($izinMenunggu ?? 0);
    $totalAktivitasBulanIni = ($cutiBulanIni ?? 0) + ($izinBulanIni ?? 0);
@endphp

{{-- Summary Cards --}}
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">

    {{-- Total Karyawan --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">
        <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-slate-500">Total Karyawan</p>
            <span class="rounded-2xl bg-blue-50 px-3 py-2 text-lg">👥</span>
        </div>

        <h2 class="mt-4 text-4xl font-bold text-slate-900">
            {{ $totalKaryawan ?? 0 }}
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Karyawan aktif terdaftar.
        </p>
    </div>

    {{-- Perlu Diproses --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">
        <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-slate-500">Perlu Diproses</p>
            <span class="rounded-2xl bg-rose-50 px-3 py-2 text-lg">⚡</span>
        </div>

        <h2 class="mt-4 text-4xl font-bold {{ $totalMenunggu > 0 ? 'text-rose-500' : 'text-slate-300' }}">
            {{ $totalMenunggu }}
        </h2>

        <div class="mt-3 flex flex-wrap gap-2 text-xs font-semibold">
            <a href="/admin/pinjaman"
               class="rounded-full bg-amber-50 px-3 py-1 text-amber-700 hover:bg-amber-100">
                Pinjaman: {{ $pinjamanMenunggu ?? 0 }}
            </a>

            <a href="/admin/cuti"
               class="rounded-full bg-blue-50 px-3 py-1 text-blue-700 hover:bg-blue-100">
                Cuti: {{ $cutiMenunggu ?? 0 }}
            </a>

            <a href="/admin/izin"
               class="rounded-full bg-rose-50 px-3 py-1 text-rose-700 hover:bg-rose-100">
                Izin: {{ $izinMenunggu ?? 0 }}
            </a>
        </div>
    </div>

    {{-- Pinjaman Disetujui --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">
        <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-slate-500">Pinjaman Disetujui</p>
            <span class="rounded-2xl bg-emerald-50 px-3 py-2 text-lg">💰</span>
        </div>

        <h2 class="mt-4 text-4xl font-bold text-emerald-600">
            {{ $pinjamanDisetujui ?? 0 }}
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Total pinjaman approved.
        </p>
    </div>

    {{-- Aktivitas Bulan Ini --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">
        <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-slate-500">Aktivitas Bulan Ini</p>
            <span class="rounded-2xl bg-indigo-50 px-3 py-2 text-lg">📊</span>
        </div>

        <h2 class="mt-4 text-4xl font-bold text-indigo-600">
            {{ $totalAktivitasBulanIni }}
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Cuti dan izin bulan ini.
        </p>
    </div>

</div>

{{-- Bottom Area --}}
<div class="mt-5 grid gap-4 xl:grid-cols-3">

    {{-- Aktivitas Terbaru --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 xl:col-span-2">

        <div class="mb-5 flex items-center justify-between gap-3">
            <div>
                <h3 class="text-lg font-bold text-slate-900">
                    Aktivitas Terbaru
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    Pengajuan terbaru dari karyawan.
                </p>
            </div>

            <span class="hidden rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 sm:inline-flex">
                Live database
            </span>
        </div>

        <div class="max-h-80 space-y-3 overflow-y-auto pr-1">
            @forelse (collect($aktivitasTerbaru ?? [])->take(5) as $aktivitas)
                <div class="flex flex-col gap-3 rounded-2xl bg-slate-50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="font-semibold text-slate-800">
                            {{ $aktivitas['nama'] ?? '-' }}
                        </p>
                        <p class="text-sm text-slate-500">
                            {{ $aktivitas['jenis'] ?? '-' }}
                        </p>
                    </div>

                    <div class="sm:text-right">
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                            {{ ($aktivitas['status'] ?? '') === 'Disetujui' ? 'bg-emerald-100 text-emerald-700' : (($aktivitas['status'] ?? '') === 'Ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                            {{ $aktivitas['status'] ?? '-' }}
                        </span>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ isset($aktivitas['tanggal']) ? $aktivitas['tanggal']->format('d M Y H:i') : '-' }}
                        </p>
                    </div>

                </div>
            @empty
                <div class="rounded-2xl bg-slate-50 px-5 py-6 text-center text-sm text-slate-500">
                    Belum ada aktivitas terbaru.
                </div>
            @endforelse
        </div>

    </div>

    {{-- Akses Cepat --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <div class="mb-5">
            <h3 class="text-lg font-bold text-slate-900">
                Akses Cepat
            </h3>
            <p class="mt-1 text-sm text-slate-500">
                Navigasi cepat admin.
            </p>
        </div>

        <div class="space-y-3">

            <a href="/admin/karyawan"
               class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                Data Karyawan
                <span>›</span>
            </a>

            <a href="/admin/pinjaman"
               class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                Data Pinjaman
                <span>›</span>
            </a>

            <a href="/admin/angsuran"
               class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                Data Angsuran
                <span>›</span>
            </a>

            <a href="/admin/cuti"
               class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                Pengajuan Cuti
                <span>›</span>
            </a>

            <a href="/admin/izin"
               class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                Izin Kerja
                <span>›</span>
            </a>

        </div>

    </div>

</div>

@endsection