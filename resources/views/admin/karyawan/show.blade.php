@extends('layouts.admin')

@section('title', 'Detail Karyawan')
@section('page-title', 'Detail Karyawan')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">
        <a href="/admin/karyawan"
           class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            ← Kembali
        </a>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">
                    {{ $karyawan->nama }}
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    {{ $karyawan->nik }} • {{ $karyawan->divisi }} • {{ $karyawan->jabatan }}
                </p>
            </div>

            <span class="inline-flex w-fit rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">
                {{ $karyawan->status }}
            </span>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase text-slate-400">NIK</p>
                <p class="mt-2 font-semibold text-slate-900">{{ $karyawan->nik ?? '-' }}</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase text-slate-400">Divisi</p>
                <p class="mt-2 font-semibold text-slate-900">{{ $karyawan->divisi ?? '-' }}</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase text-slate-400">Jabatan</p>
                <p class="mt-2 font-semibold text-slate-900">{{ $karyawan->jabatan ?? '-' }}</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase text-slate-400">No HP</p>
                <p class="mt-2 font-semibold text-slate-900">{{ $karyawan->no_hp ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-4 rounded-2xl bg-slate-50 p-4">
            <p class="text-xs font-semibold uppercase text-slate-400">Alamat</p>
            <p class="mt-2 text-sm font-medium text-slate-700">{{ $karyawan->alamat ?? '-' }}</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">

        <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200">
            <h3 class="mb-4 text-lg font-bold text-slate-900">Riwayat Pinjaman</h3>

            <div class="space-y-3">
                @forelse($pinjamans as $pinjaman)
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">
                            Rp {{ number_format($pinjaman->nominal, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-sm text-slate-500">
                            Tenor {{ $pinjaman->tenor }} bulan
                        </p>
                        <span class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-semibold
                            {{ $pinjaman->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-700' : ($pinjaman->status === 'Ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                            {{ $pinjaman->status }}
                        </span>
                    </div>
                @empty
                    <p class="rounded-2xl bg-slate-50 p-4 text-center text-sm text-slate-500">
                        Belum ada riwayat pinjaman.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200">
            <h3 class="mb-4 text-lg font-bold text-slate-900">Riwayat Cuti</h3>

            <div class="space-y-3">
                @forelse($cutis as $cuti)
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">
                            {{ $cuti->tanggal_mulai }} - {{ $cuti->tanggal_selesai }}
                        </p>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ $cuti->jumlah_hari ?? '-' }} hari
                        </p>
                        <span class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-semibold
                            {{ $cuti->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-700' : ($cuti->status === 'Ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                            {{ $cuti->status }}
                        </span>
                    </div>
                @empty
                    <p class="rounded-2xl bg-slate-50 p-4 text-center text-sm text-slate-500">
                        Belum ada riwayat cuti.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200">
            <h3 class="mb-4 text-lg font-bold text-slate-900">Riwayat Izin Kerja</h3>

            <div class="space-y-3">
                @forelse($izins as $izin)
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">
                            {{ $izin->jenis_izin }}
                        </p>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ $izin->tanggal_mulai }} - {{ $izin->tanggal_selesai }}
                        </p>
                        <p class="mt-2 text-sm text-slate-600">
                            {{ $izin->alasan }}
                        </p>

                        <div class="mt-3 flex items-center justify-between gap-3">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                {{ $izin->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-700' : ($izin->status === 'Ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                                {{ $izin->status }}
                            </span>

                            @if ($izin->lampiran)
                                <a href="{{ asset('storage/' . $izin->lampiran) }}"
                                   target="_blank"
                                   class="text-xs font-semibold text-blue-600 hover:underline">
                                    Lihat Berkas
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="rounded-2xl bg-slate-50 p-4 text-center text-sm text-slate-500">
                        Belum ada riwayat izin.
                    </p>
                @endforelse
            </div>
        </div>

    </div>

</div>

@endsection