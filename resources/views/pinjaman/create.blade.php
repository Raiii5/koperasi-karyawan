@extends('layouts.app')

@section('title', 'Tambah Pinjaman')

@section('content')

<h2 class="page-title">Tambah Pengajuan Pinjaman</h2>

<div class="form-card">
    <form action="/pinjaman" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Karyawan</label>
            <select name="karyawan_id" class="form-select" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach ($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}">
                        {{ $karyawan->nama }} - {{ $karyawan->nik }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nominal</label>
                <input type="number" name="nominal" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tenor / Lama Cicilan</label>
                <input type="number" name="tenor" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Alasan</label>
            <textarea name="alasan" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="/pinjaman" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection