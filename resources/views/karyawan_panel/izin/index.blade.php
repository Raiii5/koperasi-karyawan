@extends('layouts.karyawan')

@section('title', 'Izin Kerja')
@section('page-title', 'Izin Kerja')

@section('content')

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <p class="text-sm text-slate-500">
            Lihat riwayat izin kerja atau sakit yang pernah Anda ajukan.
        </p>
    </div>

    <a href="/karyawan/izin/create"
       class="w-fit rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
        + Ajukan Izin
    </a>

</div>

@if ($izins->count())

    {{-- Desktop / Tablet Table --}}
    <div class="hidden overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200 md:block">
        <div class="overflow-x-auto">
            <table class="min-w-[1100px] w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Tanggal Pengajuan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Jenis</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Periode</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Alasan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Lampiran</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($izins as $izin)
                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-800">
                                        {{ $izin->created_at ? $izin->created_at->format('d-m-Y') : '-' }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        {{ $izin->created_at ? $izin->created_at->format('H:i') : '-' }} WIB
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $izin->jenis_izin }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $izin->tanggal_mulai }} - {{ $izin->tanggal_selesai }}
                            </td>

                            <td class="px-6 py-4 max-w-xs text-slate-600">
                                <div class="max-h-12 overflow-hidden">
                                    {{ $izin->alasan ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $izin->status === 'Disetujui'
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : ($izin->status === 'Ditolak'
                                            ? 'bg-rose-100 text-rose-700'
                                            : 'bg-amber-100 text-amber-700') }}">
                                    {{ $izin->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if ($izin->lampiran)
                                    <a href="{{ asset('storage/' . $izin->lampiran) }}"
                                       target="_blank"
                                       class="inline-flex rounded-xl bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                        Lihat Berkas
                                    </a>
                                @else
                                    <span class="text-sm text-slate-400">Tidak ada</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="grid gap-3 md:hidden">
        @foreach ($izins as $izin)
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">

                <div class="mb-4 rounded-2xl bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Tanggal Pengajuan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $izin->created_at ? $izin->created_at->format('d-m-Y H:i') : '-' }} WIB
                    </p>
                </div>

                <div class="flex items-start justify-between gap-3">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Jenis Izin
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-slate-900">
                            {{ $izin->jenis_izin }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $izin->tanggal_mulai }} - {{ $izin->tanggal_selesai }}
                        </p>
                    </div>

                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                        {{ $izin->status === 'Disetujui'
                            ? 'bg-emerald-100 text-emerald-700'
                            : ($izin->status === 'Ditolak'
                                ? 'bg-rose-100 text-rose-700'
                                : 'bg-amber-100 text-amber-700') }}">
                        {{ $izin->status }}
                    </span>

                </div>

                <div class="mt-4 rounded-2xl bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Alasan
                    </p>

                    <p class="mt-1 text-sm text-slate-600">
                        {{ $izin->alasan ?? '-' }}
                    </p>
                </div>

                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Lampiran
                        </p>

                        <div class="mt-2">
                            @if ($izin->lampiran)
                                <a href="{{ asset('storage/' . $izin->lampiran) }}"
                                   target="_blank"
                                   class="inline-flex rounded-xl bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                    Lihat Berkas
                                </a>
                            @else
                                <span class="text-sm text-slate-400">Tidak ada</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        @if ($izin->status === 'Menunggu')
                            <span class="inline-flex rounded-2xl bg-amber-50 px-4 py-2 text-xs font-semibold text-amber-700">
                                Menunggu HRD
                            </span>
                        @elseif ($izin->status === 'Disetujui')
                            <span class="inline-flex rounded-2xl bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">
                                Izin disetujui
                            </span>
                        @else
                            <span class="inline-flex rounded-2xl bg-rose-50 px-4 py-2 text-xs font-semibold text-rose-700">
                                Izin ditolak
                            </span>
                        @endif
                    </div>

                </div>

            </div>
        @endforeach
    </div>

@else

    <div class="rounded-3xl bg-white px-6 py-10 text-center shadow-sm shadow-slate-200">
        <p class="text-sm text-slate-500">
            Belum ada pengajuan izin.
        </p>

        <a href="/karyawan/izin/create"
           class="mt-4 inline-flex rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
            Ajukan Izin Sekarang
        </a>
    </div>

@endif

@endsection