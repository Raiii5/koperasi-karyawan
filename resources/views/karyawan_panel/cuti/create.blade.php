@extends('layouts.karyawan')

@section('title', 'Ajukan Cuti')
@section('page-title', 'Ajukan Cuti')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Pengajuan Cuti
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Pilih tanggal mulai dan tanggal selesai. Jumlah hari akan dihitung otomatis oleh sistem.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Pengajuan cuti gagal dikirim.</p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/karyawan/cuti" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Tanggal Mulai</span>
                    <input
                        type="date"
                        id="tanggal_mulai"
                        name="tanggal_mulai"
                        value="{{ old('tanggal_mulai') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Tanggal Selesai</span>
                    <input
                        type="date"
                        id="tanggal_selesai"
                        name="tanggal_selesai"
                        value="{{ old('tanggal_selesai') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

            </div>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Jumlah Hari</span>
                <input
                    type="number"
                    id="jumlah_hari"
                    name="jumlah_hari"
                    value="{{ old('jumlah_hari') }}"
                    readonly
                    placeholder="Otomatis terisi setelah memilih tanggal"
                    class="mt-2 w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 outline-none">
                <p id="info_jumlah_hari" class="mt-2 text-xs text-slate-500">
                    Sistem akan menghitung jumlah hari berdasarkan tanggal mulai dan tanggal selesai.
                </p>
            </label>

            <label class="block">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-700">Alasan Cuti</span>
                    <span id="counter_alasan" class="text-xs text-slate-400">0/255 karakter</span>
                </div>

                <textarea
                    name="alasan"
                    id="alasan"
                    rows="4"
                    required
                    maxlength="255"
                    placeholder="Tuliskan alasan pengajuan cuti"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('alasan') }}</textarea>

                <p class="mt-2 text-xs text-slate-500">
                    Maksimal 255 karakter.
                </p>
            </label>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">

                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Ajukan Cuti
                </button>

                <a
                    href="/karyawan/cuti"
                    class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>

            </div>
        </form>

    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <h3 class="text-lg font-bold text-slate-900">
            Panduan Cuti
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Setiap karyawan memiliki batas maksimal cuti 12 hari dalam 1 tahun.
        </p>

        <div class="mt-5 space-y-3">

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">
                    1. Pilih Tanggal
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Pilih tanggal mulai dan tanggal selesai cuti.
                </p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">
                    2. Jumlah Hari Otomatis
                </p>
                <p class="mt-1 text-xs text-slate-500">
                    Sistem akan menghitung jumlah hari secara otomatis dan tidak dapat diedit manual.
                </p>
            </div>

            <div class="rounded-2xl bg-blue-50 p-4">
                <p class="text-sm font-semibold text-blue-700">
                    3. Batas Maksimal
                </p>
                <p class="mt-1 text-xs text-blue-600">
                    Pengajuan akan ditolak otomatis jika melebihi sisa jatah cuti.
                </p>
            </div>

        </div>

    </div>

</div>

<script>
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    const jumlahHari = document.getElementById('jumlah_hari');
    const infoJumlahHari = document.getElementById('info_jumlah_hari');
    const alasan = document.getElementById('alasan');
    const counterAlasan = document.getElementById('counter_alasan');

    function hitungJumlahHari() {
        const mulai = tanggalMulai.value;
        const selesai = tanggalSelesai.value;

        if (!mulai || !selesai) {
            jumlahHari.value = '';
            infoJumlahHari.innerText = 'Sistem akan menghitung jumlah hari berdasarkan tanggal mulai dan tanggal selesai.';
            infoJumlahHari.className = 'mt-2 text-xs text-slate-500';
            return;
        }

        const startDate = new Date(mulai);
        const endDate = new Date(selesai);

        if (endDate < startDate) {
            jumlahHari.value = '';
            infoJumlahHari.innerText = 'Tanggal selesai tidak boleh sebelum tanggal mulai.';
            infoJumlahHari.className = 'mt-2 text-xs text-rose-600';
            return;
        }

        const diffTime = endDate.getTime() - startDate.getTime();
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays < 1) {
            diffDays = 1;
        }

        jumlahHari.value = diffDays;

        if (diffDays > 12) {
            infoJumlahHari.innerText = 'Jumlah hari cuti adalah ' + diffDays + ' hari. Pengajuan ini melebihi batas maksimal 12 hari.';
            infoJumlahHari.className = 'mt-2 text-xs font-semibold text-rose-600';
        } else {
            infoJumlahHari.innerText = 'Jumlah hari cuti otomatis: ' + diffDays + ' hari.';
            infoJumlahHari.className = 'mt-2 text-xs font-semibold text-emerald-600';
        }
    }

    function updateCounterAlasan() {
        const total = alasan.value.length;
        counterAlasan.innerText = total + '/255 karakter';
    }

    tanggalMulai.addEventListener('change', hitungJumlahHari);
    tanggalSelesai.addEventListener('change', hitungJumlahHari);
    alasan.addEventListener('input', updateCounterAlasan);

    hitungJumlahHari();
    updateCounterAlasan();
</script>

@endsection