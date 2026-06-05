@extends('layouts.admin')

@section('title', 'Data Karyawan')
@section('page-title', 'Data Karyawan')

@section('content')

<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

    <div class="w-full lg:w-96">
        <input
            type="text"
            id="searchInput"
            placeholder="Cari nama atau ID karyawan..."
            autocomplete="off"
            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

        <p id="searchInfo" class="mt-2 text-xs text-slate-500"></p>
    </div>

    <a href="/admin/karyawan/create"
       class="w-fit rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
        + Tambah Karyawan
    </a>

</div>

@if ($karyawans->count())

    {{-- Desktop / Tablet Table --}}
    <div class="hidden overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200 md:block">
        <div class="overflow-x-auto">
            <table class="min-w-[1050px] w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">No</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">ID Karyawan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Nama</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Divisi</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Jabatan</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($karyawans as $karyawan)
                        <tr
                            class="karyawan-item hover:bg-slate-50"
                            data-nama="{{ strtolower($karyawan->nama) }}"
                            data-idkaryawan="{{ strtolower($karyawan->id_karyawan ?? '') }}">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-blue-700">
                                {{ $karyawan->id_karyawan ?? '-' }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $karyawan->nama }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $karyawan->divisi }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $karyawan->jabatan }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $karyawan->status === 'Aktif'
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : 'bg-rose-100 text-rose-700' }}">
                                    {{ $karyawan->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="/admin/karyawan/{{ $karyawan->id }}"
                                       class="inline-flex rounded-xl bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                        Detail
                                    </a>

                                    <a href="/admin/karyawan/{{ $karyawan->id }}/edit"
                                       class="inline-flex rounded-xl bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition hover:bg-amber-100">
                                        Edit
                                    </a>

                                    <form action="/admin/karyawan/{{ $karyawan->id }}/toggle-status"
                                          method="POST"
                                          data-confirm="Yakin ingin mengubah status karyawan ini?"
                                          data-confirm-title="Ubah Status Karyawan"
                                          data-confirm-button="Ya, Ubah Status"
                                          data-confirm-type="{{ $karyawan->status === 'Aktif' ? 'danger' : 'success' }}">
                                        @csrf

                                        <button type="submit"
                                                class="inline-flex rounded-xl px-3 py-2 text-xs font-semibold transition
                                                {{ $karyawan->status === 'Aktif'
                                                    ? 'bg-rose-50 text-rose-700 hover:bg-rose-100'
                                                    : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                                            {{ $karyawan->status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <tr id="emptySearchRowTable" class="hidden">
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                            Data karyawan tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="grid gap-3 md:hidden">
        @foreach ($karyawans as $karyawan)
            <div
                class="karyawan-item rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200"
                data-nama="{{ strtolower($karyawan->nama) }}"
                data-idkaryawan="{{ strtolower($karyawan->id_karyawan ?? '') }}">

                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                            ID Karyawan: {{ $karyawan->id_karyawan ?? '-' }}
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-slate-900">
                            {{ $loop->iteration }}. {{ $karyawan->nama }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $karyawan->divisi }} • {{ $karyawan->jabatan }}
                        </p>
                    </div>

                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                        {{ $karyawan->status === 'Aktif'
                            ? 'bg-emerald-100 text-emerald-700'
                            : 'bg-rose-100 text-rose-700' }}">
                        {{ $karyawan->status }}
                    </span>
                </div>

                <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-4">
                    <p class="text-xs text-slate-400">
                        No: {{ $loop->iteration }}
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <a href="/admin/karyawan/{{ $karyawan->id }}"
                           class="rounded-xl bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                            Detail
                        </a>

                        <a href="/admin/karyawan/{{ $karyawan->id }}/edit"
                           class="rounded-xl bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition hover:bg-amber-100">
                            Edit
                        </a>

                        <form action="/admin/karyawan/{{ $karyawan->id }}/toggle-status"
                              method="POST"
                              data-confirm="Yakin ingin mengubah status karyawan ini?"
                              data-confirm-title="Ubah Status Karyawan"
                              data-confirm-button="Ya, Ubah Status"
                              data-confirm-type="{{ $karyawan->status === 'Aktif' ? 'danger' : 'success' }}">
                            @csrf

                            <button type="submit"
                                    class="rounded-xl px-3 py-2 text-xs font-semibold transition
                                    {{ $karyawan->status === 'Aktif'
                                        ? 'bg-rose-50 text-rose-700 hover:bg-rose-100'
                                        : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                                {{ $karyawan->status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach

        <div id="emptySearchRowMobile" class="hidden rounded-3xl bg-white p-6 text-center text-sm text-slate-500 shadow-sm shadow-slate-200">
            Data karyawan tidak ditemukan.
        </div>
    </div>

@else

    <div class="rounded-3xl bg-white px-6 py-10 text-center text-sm text-slate-500 shadow-sm shadow-slate-200">
        Belum ada data karyawan.
    </div>

@endif

<script>
    const searchInput = document.getElementById('searchInput');
    const searchInfo = document.getElementById('searchInfo');
    const items = document.querySelectorAll('.karyawan-item');
    const emptyTable = document.getElementById('emptySearchRowTable');
    const emptyMobile = document.getElementById('emptySearchRowMobile');

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        items.forEach(item => {
            const nama = item.dataset.nama;
            const idKaryawan = item.dataset.idkaryawan;

            if (nama.includes(keyword) || idKaryawan.includes(keyword)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (keyword === '') {
            searchInfo.innerText = '';

            if (emptyTable) emptyTable.classList.add('hidden');
            if (emptyMobile) emptyMobile.classList.add('hidden');

            return;
        }

        searchInfo.innerText = visibleCount + ' data ditemukan';

        if (visibleCount === 0) {
            if (emptyTable) emptyTable.classList.remove('hidden');
            if (emptyMobile) emptyMobile.classList.remove('hidden');
        } else {
            if (emptyTable) emptyTable.classList.add('hidden');
            if (emptyMobile) emptyMobile.classList.add('hidden');
        }
    });
</script>

@endsection