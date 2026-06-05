@extends('layouts.karyawan')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Statistik Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-5">

    {{-- Sisa Cuti --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex flex-col gap-2">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 uppercase tracking-wide">Sisa Cuti</span>
            <span class="text-xl">🌿</span>
        </div>
        <p class="text-3xl font-bold text-indigo-600">{{ $sisaCuti ?? 0 }}</p>
        <div class="text-xs text-slate-400">
            <span class="text-slate-600 font-medium">{{ $cutiTerpakai ?? 0 }} terpakai</span>
            &nbsp;/&nbsp;{{ $jatahCuti ?? 0 }} hari
        </div>

        @if(($jatahCuti ?? 0) > 0)
            <div class="w-full bg-slate-100 rounded-full h-1.5 mt-1">
                <div class="bg-indigo-400 h-1.5 rounded-full transition-all"
                     style="width: {{ min(100, (($cutiTerpakai ?? 0) / ($jatahCuti ?? 1)) * 100) }}%">
                </div>
            </div>
        @endif
    </div>

    {{-- Total Pinjaman --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex flex-col gap-2">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Pinjaman</span>
            <span class="text-xl">💳</span>
        </div>
        <p class="text-2xl font-bold text-slate-800 leading-tight">
            {{ $totalPinjaman ?? 0 }}
        </p>
        <p class="text-xs text-slate-400">Total pengajuan pinjaman</p>
    </div>

    {{-- Pinjaman Menunggu --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex flex-col gap-2">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 uppercase tracking-wide">Pinjaman Diproses</span>
            <span class="text-xl">⏳</span>
        </div>
        <p class="text-3xl font-bold {{ ($pinjamanMenunggu ?? 0) > 0 ? 'text-amber-500' : 'text-slate-300' }}">
            {{ $pinjamanMenunggu ?? 0 }}
        </p>
        <span class="text-xs inline-flex items-center gap-1 w-fit px-2 py-0.5 rounded-full
            {{ ($pinjamanMenunggu ?? 0) > 0 ? 'bg-amber-50 text-amber-600' : 'bg-slate-50 text-slate-400' }}">
            {{ ($pinjamanMenunggu ?? 0) > 0 ? 'Sedang diproses' : 'Tidak ada' }}
        </span>
    </div>

    {{-- Izin Menunggu --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex flex-col gap-2">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 uppercase tracking-wide">Izin Diproses</span>
            <span class="text-xl">📋</span>
        </div>
        <p class="text-3xl font-bold {{ ($izinMenunggu ?? 0) > 0 ? 'text-rose-500' : 'text-slate-300' }}">
            {{ $izinMenunggu ?? 0 }}
        </p>
        <span class="text-xs inline-flex items-center gap-1 w-fit px-2 py-0.5 rounded-full
            {{ ($izinMenunggu ?? 0) > 0 ? 'bg-rose-50 text-rose-600' : 'bg-slate-50 text-slate-400' }}">
            {{ ($izinMenunggu ?? 0) > 0 ? 'Sedang diproses' : 'Tidak ada' }}
        </span>
    </div>

</div>

{{-- Quick Actions --}}
<div class="mb-5">
    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-3">Akses Cepat</h3>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

        <a href="/karyawan/pinjaman/create"
           class="group bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex items-center gap-4
                  hover:border-indigo-300 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-xl shrink-0
                        group-hover:bg-indigo-100 transition-colors">
                💰
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-700 group-hover:text-indigo-600 transition-colors">Ajukan Pinjaman</p>
                <p class="text-xs text-slate-400">Buat pengajuan baru</p>
            </div>
            <span class="ml-auto text-slate-300 group-hover:text-indigo-400 transition-colors text-lg">›</span>
        </a>

        <a href="/karyawan/cuti/create"
           class="group bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex items-center gap-4
                  hover:border-emerald-300 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-xl shrink-0
                        group-hover:bg-emerald-100 transition-colors">
                🗓️
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors">Ajukan Cuti</p>
                <p class="text-xs text-slate-400">Sisa {{ $sisaCuti ?? 0 }} hari tersedia</p>
            </div>
            <span class="ml-auto text-slate-300 group-hover:text-emerald-400 transition-colors text-lg">›</span>
        </a>

        <a href="/karyawan/izin/create"
           class="group bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex items-center gap-4
                  hover:border-rose-300 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-xl shrink-0
                        group-hover:bg-rose-100 transition-colors">
                📝
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-700 group-hover:text-rose-600 transition-colors">Ajukan Izin</p>
                <p class="text-xs text-slate-400">Izin tidak masuk kerja</p>
            </div>
            <span class="ml-auto text-slate-300 group-hover:text-rose-400 transition-colors text-lg">›</span>
        </a>

    </div>
</div>

{{-- Info Panel --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-sm font-semibold text-slate-700">Pinjaman Saya</h4>
            <a href="/karyawan/pinjaman"
               class="text-xs text-indigo-500 hover:text-indigo-700 hover:underline transition-colors">
                Lihat semua →
            </a>
        </div>

        <div class="space-y-2">
            <div class="flex items-center justify-between py-2 border-t border-slate-100">
                <span class="text-xs text-slate-500">Total Pengajuan</span>
                <span class="text-sm font-semibold text-slate-800">{{ $totalPinjaman ?? 0 }}</span>
            </div>

            <div class="flex items-center justify-between py-2 border-t border-slate-100">
                <span class="text-xs text-slate-500">Menunggu Persetujuan</span>
                <span class="text-sm font-semibold {{ ($pinjamanMenunggu ?? 0) > 0 ? 'text-amber-600' : 'text-slate-400' }}">
                    {{ $pinjamanMenunggu ?? 0 }} pengajuan
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-sm font-semibold text-slate-700">Cuti & Izin</h4>
            <a href="/karyawan/cuti"
               class="text-xs text-indigo-500 hover:text-indigo-700 hover:underline transition-colors">
                Lihat semua →
            </a>
        </div>

        <div class="space-y-2">
            <div class="flex items-center justify-between py-2 border-t border-slate-100">
                <span class="text-xs text-slate-500">Jatah Cuti</span>
                <span class="text-sm font-semibold text-slate-800">{{ $jatahCuti ?? 0 }} hari</span>
            </div>

            <div class="flex items-center justify-between py-2 border-t border-slate-100">
                <span class="text-xs text-slate-500">Terpakai / Sisa</span>
                <span class="text-sm font-semibold text-slate-800">
                    {{ $cutiTerpakai ?? 0 }}
                    <span class="text-slate-400 font-normal">/</span>
                    {{ $sisaCuti ?? 0 }} hari
                </span>
            </div>

            <div class="flex items-center justify-between py-2 border-t border-slate-100">
                <span class="text-xs text-slate-500">Izin Menunggu</span>
                <span class="text-sm font-semibold {{ ($izinMenunggu ?? 0) > 0 ? 'text-rose-600' : 'text-slate-400' }}">
                    {{ $izinMenunggu ?? 0 }} pengajuan
                </span>
            </div>
        </div>
    </div>

</div>

@endsection