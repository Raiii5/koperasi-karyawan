@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2 class="page-title">Dashboard</h2>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card card-stat p-3">
            <div class="text-muted">Total Karyawan</div>
            <h2 class="fw-bold">{{ $totalKaryawan }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat p-3">
            <div class="text-muted">Total Pinjaman</div>
            <h2 class="fw-bold">{{ $totalPinjaman }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat p-3">
            <div class="text-muted">Menunggu Approval</div>
            <h2 class="fw-bold text-warning">{{ $pinjamanMenunggu }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stat p-3">
            <div class="text-muted">Disetujui</div>
            <h2 class="fw-bold text-success">{{ $pinjamanDisetujui }}</h2>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-stat p-4">
            <h5>Total Angsuran Masuk</h5>
            <h2 class="fw-bold text-primary">
                Rp {{ number_format($totalAngsuran, 0, ',', '.') }}
            </h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-stat p-4">
            <h5>Status Sistem</h5>
            <p class="mb-1">Aplikasi koperasi perusahaan berjalan normal.</p>
            <span class="badge bg-success">Aktif</span>
        </div>
    </div>
</div>

@endsection