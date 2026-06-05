@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')

<h2 class="page-title">Tambah Karyawan</h2>

<div class="form-card">
    <form action="/karyawan" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Divisi</label>
                <input type="text" name="divisi" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="/karyawan" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection