 @extends('layouts.admin')

@section('title', 'Pengajuan Cuti')
@section('page-title', 'Pengajuan Cuti')

@section('content')

@if ($cutis->count())

    {{-- Desktop / Tablet Table --}}
    <div class="hidden overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200 md:block">
        <div class="overflow-x-auto">
            <table class="min-w-[1200px] w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Tanggal Pengajuan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Karyawan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Periode</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Jumlah Hari</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Alasan Pengajuan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Catatan Admin</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Aksi</th>
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

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $cuti->karyawan->nama ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $cuti->tanggal_mulai }} - {{ $cuti->tanggal_selesai }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $cuti->jumlah_hari }} hari
                            </td>

                            <td class="px-6 py-4 max-w-xs text-slate-600">
                                <div class="max-h-12 overflow-hidden">
                                    {{ $cuti->alasan ?? '-' }}
                                </div>
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

                            <td class="px-6 py-4 text-slate-600">
                                {{ $cuti->catatan_admin ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($cuti->status === 'Menunggu')
                                    <div class="flex flex-wrap gap-2">
                                        <a href="/admin/cuti/{{ $cuti->id }}/approve"
                                           data-confirm="Yakin ingin menyetujui pengajuan cuti ini?"
                                           data-confirm-title="Setujui Pengajuan Cuti"
                                           data-confirm-button="Ya, Setujui"
                                           data-confirm-type="success"
                                           class="rounded-2xl bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                                            Approve
                                        </a>

                                        <a href="/admin/cuti/{{ $cuti->id }}/reject"
                                           data-confirm="Yakin ingin menolak pengajuan cuti ini?"
                                           data-confirm-title="Tolak Pengajuan Cuti"
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
                            Karyawan
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-slate-900">
                            {{ $cuti->karyawan->nama ?? '-' }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $cuti->tanggal_mulai }} - {{ $cuti->tanggal_selesai }}
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

                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Jumlah Hari
                        </p>

                        <p class="mt-1 text-2xl font-bold text-slate-900">
                            {{ $cuti->jumlah_hari }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Status
                        </p>

                        <p class="mt-2 text-sm font-semibold text-slate-700">
                            {{ $cuti->status }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 rounded-2xl bg-blue-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                        Alasan Pengajuan
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $cuti->alasan ?? '-' }}
                    </p>
                </div>

                <div class="mt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Catatan Admin
                    </p>

                    <p class="mt-1 text-sm text-slate-600">
                        {{ $cuti->catatan_admin ?? '-' }}
                    </p>
                </div>

                <div class="mt-4 border-t border-slate-100 pt-4">
                    @if ($cuti->status === 'Menunggu')
                        <div class="flex flex-wrap gap-2">
                            <a href="/admin/cuti/{{ $cuti->id }}/approve"
                               data-confirm="Yakin ingin menyetujui pengajuan cuti ini?"
                               data-confirm-title="Setujui Pengajuan Cuti"
                               data-confirm-button="Ya, Setujui"
                               data-confirm-type="success"
                               class="rounded-2xl bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                                Approve
                            </a>

                            <a href="/admin/cuti/{{ $cuti->id }}/reject"
                               data-confirm="Yakin ingin menolak pengajuan cuti ini?"
                               data-confirm-title="Tolak Pengajuan Cuti"
                               data-confirm-button="Ya, Tolak"
                               data-confirm-type="danger"
                               class="rounded-2xl bg-rose-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-rose-700">
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
        Belum ada pengajuan cuti.
    </div>

@endif

@endsection