@extends('layouts.karyawan')

@section('title', 'Pinjaman Saya')
@section('page-title', 'Pinjaman Saya')

@section('content')

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <p class="text-sm text-slate-500">
            Daftar pengajuan pinjaman yang pernah Anda ajukan.
        </p>
    </div>

    <a href="/karyawan/pinjaman/create"
       class="w-fit rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
        + Ajukan Pinjaman
    </a>

</div>

@if ($pinjamans->count())

    {{-- Desktop / Tablet Table --}}
    <div class="hidden overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200 md:block">
        <div class="overflow-x-auto">
            <table class="min-w-[1100px] w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Nominal</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Tenor</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Kesanggupan Bayar</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Alasan Pengajuan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Catatan Admin</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($pinjamans as $pinjaman)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-bold text-slate-900">
                                Rp {{ number_format($pinjaman->nominal ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $pinjaman->tenor }} bulan
                            </td>

                            <td class="px-6 py-4">
                                @if (!empty($pinjaman->kesanggupan_bayar))
                                    <div>
                                        <p class="font-semibold text-blue-600">
                                            Rp {{ number_format($pinjaman->kesanggupan_bayar ?? 0, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-slate-400">
                                            per bulan
                                        </p>
                                    </div>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 max-w-xs text-slate-600">
                                <div class="max-h-12 overflow-hidden">
                                    {{ $pinjaman->alasan ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $pinjaman->status === 'Disetujui'
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : ($pinjaman->status === 'Ditolak'
                                            ? 'bg-rose-100 text-rose-700'
                                            : 'bg-amber-100 text-amber-700') }}">
                                    {{ $pinjaman->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $pinjaman->catatan_admin ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="grid gap-3 md:hidden">
        @foreach ($pinjamans as $pinjaman)
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">

                <div class="flex items-start justify-between gap-3">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Nominal Pinjaman
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-slate-900">
                            Rp {{ number_format($pinjaman->nominal ?? 0, 0, ',', '.') }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Tenor {{ $pinjaman->tenor }} bulan
                        </p>
                    </div>

                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                        {{ $pinjaman->status === 'Disetujui'
                            ? 'bg-emerald-100 text-emerald-700'
                            : ($pinjaman->status === 'Ditolak'
                                ? 'bg-rose-100 text-rose-700'
                                : 'bg-amber-100 text-amber-700') }}">
                        {{ $pinjaman->status }}
                    </span>

                </div>

                <div class="mt-4 rounded-2xl bg-emerald-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">
                        Kesanggupan Bayar
                    </p>

                    @if (!empty($pinjaman->kesanggupan_bayar))
                        <p class="mt-1 text-xl font-bold text-emerald-700">
                            Rp {{ number_format($pinjaman->kesanggupan_bayar ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="mt-1 text-xs text-emerald-600">
                            per bulan
                        </p>
                    @else
                        <p class="mt-1 text-sm text-slate-500">
                            Belum diisi
                        </p>
                    @endif
                </div>

                <div class="mt-4 rounded-2xl bg-blue-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                        Alasan Pengajuan
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $pinjaman->alasan ?? '-' }}
                    </p>
                </div>

                <div class="mt-4 rounded-2xl bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Catatan Admin
                    </p>

                    <p class="mt-1 text-sm text-slate-600">
                        {{ $pinjaman->catatan_admin ?? '-' }}
                    </p>
                </div>

                <div class="mt-4 border-t border-slate-100 pt-4">
                    @if ($pinjaman->status === 'Menunggu')
                        <span class="inline-flex rounded-2xl bg-amber-50 px-4 py-2 text-xs font-semibold text-amber-700">
                            Menunggu persetujuan HRD
                        </span>
                    @elseif ($pinjaman->status === 'Disetujui')
                        <span class="inline-flex rounded-2xl bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">
                            Pinjaman disetujui
                        </span>
                    @else
                        <span class="inline-flex rounded-2xl bg-rose-50 px-4 py-2 text-xs font-semibold text-rose-700">
                            Pinjaman ditolak
                        </span>
                    @endif
                </div>

            </div>
        @endforeach
    </div>

@else

    <div class="rounded-3xl bg-white px-6 py-10 text-center shadow-sm shadow-slate-200">
        <p class="text-sm text-slate-500">
            Belum ada pengajuan pinjaman.
        </p>

        <a href="/karyawan/pinjaman/create"
           class="mt-4 inline-flex rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
            Ajukan Pinjaman Sekarang
        </a>
    </div>

@endif

@endsection