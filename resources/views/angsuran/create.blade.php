@extends('layouts.app')

@section('title', 'Tambah Angsuran')

@section('content')

<h2 class="page-title">Tambah Angsuran</h2>

<div class="form-card">
    <form action="/angsuran" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pinjaman Disetujui</label>
            <select name="pinjaman_id" class="form-select" required>
                <option value="">-- Pilih Pinjaman --</option>
                @foreach ($pinjamans as $pinjaman)
                    <option value="{{ $pinjaman->id }}">
                        {{ $pinjaman->karyawan->nama }} - Rp {{ number_format($pinjaman->nominal, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nominal Bayar</label>
                <input type="number" name="nominal_bayar" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Bayar</label>
                <input type="date" name="tanggal_bayar" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="/angsuran" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection