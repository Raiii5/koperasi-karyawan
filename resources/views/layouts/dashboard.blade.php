@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card p-4">
            <h6>Total Karyawan</h6>
            <h2>{{ $totalKaryawan }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <h6>Total Pinjaman</h6>
            <h2>{{ $totalPinjaman }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <h6>Total Angsuran</h6>
            <h2>{{ $totalAngsuran }}</h2>
        </div>
    </div>
</div>

<div class="card p-4">
    <h5 class="fw-bold mb-3">Sistem Koperasi Karyawan</h5>
    <p>
        Aplikasi ini digunakan untuk mengelola data karyawan, pengajuan pinjaman,
        persetujuan pinjaman, penolakan pinjaman, serta pencatatan angsuran karyawan.
    </p>
</div>

@endsection