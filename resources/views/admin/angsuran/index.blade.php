@extends('layouts.admin')

@section('title', 'Data Angsuran')
@section('page-title', 'Data Angsuran')

@section('content')

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        
    </div>

    <a href="/admin/angsuran/create"
       class="w-fit rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
        + Tambah Angsuran
    </a>

</div>

@if ($angsurans->count())

    {{-- Desktop / Tablet Table --}}
    <div class="hidden overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200 md:block">
        <div class="overflow-x-auto">
            <table class="min-w-[950px] w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">ID</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Karyawan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Total Pinjaman</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Nominal Bayar</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Tanggal Bayar</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Keterangan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($angsurans as $angsuran)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                {{ $angsuran->id }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $angsuran->pinjaman->karyawan->nama ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($angsuran->pinjaman->nominal ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 font-bold text-emerald-600">
                                Rp {{ number_format($angsuran->nominal_bayar ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $angsuran->tanggal_bayar ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $angsuran->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="grid gap-3 md:hidden">
        @foreach ($angsurans as $angsuran)
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">

                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Karyawan
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-slate-900">
                            {{ $angsuran->pinjaman->karyawan->nama ?? '-' }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            ID Angsuran: {{ $angsuran->id }}
                        </p>
                    </div>

                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                        Dibayar
                    </span>
                </div>

                <div class="mt-4 grid grid-cols-1 gap-3">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Total Pinjaman
                        </p>

                        <p class="mt-1 text-lg font-bold text-slate-900">
                            Rp {{ number_format($angsuran->pinjaman->nominal ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600">
                            Nominal Bayar
                        </p>

                        <p class="mt-1 text-2xl font-bold text-emerald-700">
                            Rp {{ number_format($angsuran->nominal_bayar ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Tanggal Bayar
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $angsuran->tanggal_bayar ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Keterangan
                        </p>

                        <p class="mt-1 text-sm text-slate-600">
                            {{ $angsuran->keterangan ?? '-' }}
                        </p>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

@else

    <div class="rounded-3xl bg-white px-6 py-10 text-center text-sm text-slate-500 shadow-sm shadow-slate-200">
        Belum ada data angsuran.
    </div>

@endif

@endsection