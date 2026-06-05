@extends('layouts.app')

@section('title', 'Data Angsuran')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Data Angsuran</h2>
    <a href="/angsuran/create" class="btn btn-primary">+ Tambah Angsuran</a>
</div>

<div class="table-card">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Karyawan</th>
                <th>Total Pinjaman</th>
                <th>Nominal Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($angsurans as $angsuran)
                <tr>
                    <td>{{ $angsuran->id }}</td>
                    <td class="fw-semibold">{{ $angsuran->pinjaman->karyawan->nama }}</td>
                    <td>Rp {{ number_format($angsuran->pinjaman->nominal, 0, ',', '.') }}</td>
                    <td class="text-success fw-bold">
                        Rp {{ number_format($angsuran->nominal_bayar, 0, ',', '.') }}
                    </td>
                    <td>{{ $angsuran->tanggal_bayar }}</td>
                    <td>{{ $angsuran->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data angsuran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection