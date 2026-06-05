@extends('layouts.karyawan')

@section('title', 'Ajukan Izin Kerja')
@section('page-title', 'Ajukan Izin Kerja')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200 lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Form Pengajuan Izin Kerja
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Ajukan izin kerja atau sakit dengan lampiran foto jika diperlukan.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                <p class="font-semibold">Pengajuan izin gagal dikirim.</p>
                <p class="mt-1">Silakan periksa kembali data berikut:</p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/karyawan/izin" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Jenis Izin</span>

                    <select
                        name="jenis_izin"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="">Pilih jenis izin</option>
                        <option value="Sakit" {{ old('jenis_izin') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="Mendesak" {{ old('jenis_izin') == 'Mendesak' ? 'selected' : '' }}>Mendesak</option>
                        <option value="Lainnya" {{ old('jenis_izin') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Tanggal Mulai</span>

                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="{{ old('tanggal_mulai') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

            </div>

            <div class="grid gap-6 md:grid-cols-2">

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Tanggal Selesai</span>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="{{ old('tanggal_selesai') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Lampiran Foto</span>

                    <input
                        type="file"
                        name="lampiran"
                        accept="image/png,image/jpeg,image/jpg,image/webp"
                        class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <p class="mt-2 text-xs text-slate-500">
                        Hanya gambar JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                    </p>
                </label>

            </div>

            <label class="block">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-700">Alasan</span>
                    <span id="alasanIzinCounter" class="text-xs text-slate-500">
                        {{ strlen(old('alasan', '')) }}/100 karakter
                    </span>
                </div>

                <textarea
                    name="alasan"
                    rows="4"
                    maxlength="100"
                    required
                    oninput="document.getElementById('alasanIzinCounter').innerText = this.value.length + '/100 karakter'"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    placeholder="Tuliskan alasan izin maksimal 100 karakter">{{ old('alasan') }}</textarea>

                <p class="mt-2 text-xs text-slate-500">
                    Maksimal 100 karakter.
                </p>
            </label>

            <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">
                <button
                    type="submit"
                    class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Ajukan Izin
                </button>

                <a
                    href="/karyawan/izin"
                    class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>
            </div>

        </form>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200">

        <h3 class="text-lg font-bold text-slate-900">
            Ketentuan Lampiran
        </h3>

        <p class="mt-2 text-sm text-slate-500">
            Lampiran digunakan untuk bukti izin, khususnya izin sakit atau keperluan mendesak.
        </p>

        <div class="mt-5 space-y-3">
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Format File</p>
                <p class="mt-1 text-xs text-slate-500">Hanya foto JPG, JPEG, PNG, atau WEBP.</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Ukuran File</p>
                <p class="mt-1 text-xs text-slate-500">Maksimal 5 MB.</p>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-700">Status Pengajuan</p>
                <p class="mt-1 text-xs text-slate-500">Status awal adalah Menunggu sampai diproses HRD.</p>
            </div>
        </div>

    </div>

</div>

@endsection