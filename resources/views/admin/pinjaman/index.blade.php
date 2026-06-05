@extends('layouts.admin')

@section('title', 'Pengajuan Pinjaman')
@section('page-title', 'Pengajuan Pinjaman')

@section('content')

@if ($pinjamans->count())

    {{-- Desktop / Tablet Table --}}
    <div class="hidden overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200 md:block">
        <div class="overflow-x-auto">
            <table class="min-w-[1250px] w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Karyawan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Nominal</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Tenor</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Kesanggupan Bayar</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Alasan Pengajuan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Catatan Admin</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($pinjamans as $pinjaman)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $pinjaman->karyawan->nama ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
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

                            <td class="px-6 py-4">
                                @if ($pinjaman->status === 'Menunggu')
                                    <div class="flex flex-wrap gap-2">
                                        <a href="/admin/pinjaman/{{ $pinjaman->id }}/approve"
                                           data-confirm="Yakin ingin menyetujui pengajuan pinjaman ini?"
                                           data-confirm-title="Setujui Pengajuan Pinjaman"
                                           data-confirm-button="Ya, Setujui"
                                           data-confirm-type="success"
                                           class="rounded-2xl bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                                            Approve
                                        </a>

                                        <a href="/admin/pinjaman/{{ $pinjaman->id }}/reject"
                                           data-confirm="Yakin ingin menolak pengajuan pinjaman ini?"
                                           data-confirm-title="Tolak Pengajuan Pinjaman"
                                           data-confirm-button="Ya, Tolak"
                                           data-confirm-type="danger"
                                           class="rounded-2xl bg-rose-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-rose-700">
                                            Reject
                                        </a>
                                    </div>
                                @else
                                    <span class="text-sm text-slate-500">Selesai</span>
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
        @foreach ($pinjamans as $pinjaman)
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200">

                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Karyawan
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-slate-900">
                            {{ $pinjaman->karyawan->nama ?? '-' }}
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

                <div class="mt-4 rounded-2xl bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Nominal Pinjaman
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        Rp {{ number_format($pinjaman->nominal ?? 0, 0, ',', '.') }}
                    </p>
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

                <div class="mt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Catatan Admin
                    </p>

                    <p class="mt-1 text-sm text-slate-600">
                        {{ $pinjaman->catatan_admin ?? '-' }}
                    </p>
                </div>

                <div class="mt-4 border-t border-slate-100 pt-4">
                    @if ($pinjaman->status === 'Menunggu')
                        <div class="flex flex-wrap gap-2">
                            <a href="/admin/pinjaman/{{ $pinjaman->id }}/approve"
                               data-confirm="Yakin ingin menyetujui pengajuan pinjaman ini?"
                               data-confirm-title="Setujui Pengajuan Pinjaman"
                               data-confirm-button="Ya, Setujui"
                               data-confirm-type="success"
                               class="rounded-2xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                                Approve
                            </a>

                            <a href="/admin/pinjaman/{{ $pinjaman->id }}/reject"
                               data-confirm="Yakin ingin menolak pengajuan pinjaman ini?"
                               data-confirm-title="Tolak Pengajuan Pinjaman"
                               data-confirm-button="Ya, Tolak"
                               data-confirm-type="danger"
                               class="rounded-2xl bg-rose-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-rose-700">
                                Reject
                            </a>
                        </div>
                    @else
                        <span class="inline-flex rounded-2xl bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-500">
                            Pengajuan selesai diproses
                        </span>
                    @endif
                </div>

            </div>
        @endforeach
    </div>

@else

    <div class="rounded-3xl bg-white px-6 py-10 text-center text-sm text-slate-500 shadow-sm shadow-slate-200">
        Tidak ada pengajuan pinjaman.
    </div>

@endif

@endsection