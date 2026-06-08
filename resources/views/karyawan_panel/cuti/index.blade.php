@extends('layouts.karyawan')

@section('title', 'Cuti Saya')
@section('page-title', 'Cuti Saya')

@section('content')

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <p class="text-sm text-slate-500">
            Lihat riwayat pengajuan cuti dan status persetujuannya.
        </p>
    </div>

    <a href="/karyawan/cuti/create"
       class="w-fit rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
        + Ajukan Cuti
    </a>

</div>

@if ($cutis->count())

    {{-- Desktop / Tablet Table --}}
    <div class="hidden overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200 md:block">
        <div class="overflow-x-auto">
            <table class="min-w-[1050px] w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Tanggal Pengajuan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Periode</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Jumlah Hari</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Alasan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($cutis as $cuti)
                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-800">
                                        {{ $cuti->created_at ? $cuti->created_at->format('d-m-Y') : '-' }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        {{ $cuti->created_at ? $cuti->created_at->format('H:i') : '-' }} WIB
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                {{ $cuti->tanggal_mulai }} - {{ $cuti->tanggal_selesai }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $cuti->jumlah_hari }} hari
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $cuti->status === 'Disetujui'
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : ($cuti->status === 'Ditolak'
                                            ? 'bg-rose-100 text-rose-700'
                                            : 'bg-amber-100 text-amber-700') }}">
                                    {{ $cuti->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 max-w-xs text-slate-600">
                                <div class="max-h-12 overflow-hidden">
                                    {{ $cuti->alasan ?? '-' }}
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="grid gap-3 md:hidden">
        @foreach ($cutis as $cuti)
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">

                <div class="mb-4 rounded-2xl bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Tanggal Pengajuan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $cuti->created_at ? $cuti->created_at->format('d-m-Y H:i') : '-' }} WIB
                    </p>
                </div>

                <div class="flex items-start justify-between gap-3">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Periode Cuti
                        </p>

                        <h3 class="mt-1 text-base font-bold text-slate-900">
                            {{ $cuti->tanggal_mulai }} - {{ $cuti->tanggal_selesai }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $cuti->jumlah_hari }} hari
                        </p>
                    </div>

                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                        {{ $cuti->status === 'Disetujui'
                            ? 'bg-emerald-100 text-emerald-700'
                            : ($cuti->status === 'Ditolak'
                                ? 'bg-rose-100 text-rose-700'
                                : 'bg-amber-100 text-amber-700') }}">
                        {{ $cuti->status }}
                    </span>

                </div>

                <div class="mt-4 rounded-2xl bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Alasan
                    </p>

                    <p class="mt-1 text-sm text-slate-600">
                        {{ $cuti->alasan ?? '-' }}
                    </p>
                </div>

                <div class="mt-4 border-t border-slate-100 pt-4">
                    @if ($cuti->status === 'Menunggu')
                        <span class="inline-flex rounded-2xl bg-amber-50 px-4 py-2 text-xs font-semibold text-amber-700">
                            Menunggu persetujuan HRD
                        </span>
                    @elseif ($cuti->status === 'Disetujui')
                        <span class="inline-flex rounded-2xl bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">
                            Cuti disetujui
                        </span>
                    @else
                        <span class="inline-flex rounded-2xl bg-rose-50 px-4 py-2 text-xs font-semibold text-rose-700">
                            Cuti ditolak
                        </span>
                    @endif
                </div>

            </div>
        @endforeach
    </div>

@else

    <div class="rounded-3xl bg-white px-6 py-10 text-center shadow-sm shadow-slate-200">
        <p class="text-sm text-slate-500">
            Belum ada pengajuan cuti.
        </p>

        <a href="/karyawan/cuti/create"
           class="mt-4 inline-flex rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
            Ajukan Cuti Sekarang
        </a>
    </div>

@endif

@endsection