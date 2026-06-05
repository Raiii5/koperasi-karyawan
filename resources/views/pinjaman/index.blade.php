@extends('layouts.app')

@section('title', 'Data Pinjaman')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Data Pinjaman</h2>
    <a href="/pinjaman/create" class="btn btn-primary">+ Tambah Pengajuan</a>
</div>

<div class="table-card">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Karyawan</th>
                <th>Nominal</th>
                <th>Tenor</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pinjamans as $pinjaman)
                <tr>
                    <td>{{ $pinjaman->id }}</td>
                    <td class="fw-semibold">{{ $pinjaman->karyawan->nama }}</td>
                    <td>Rp {{ number_format($pinjaman->nominal, 0, ',', '.') }}</td>
                    <td>{{ $pinjaman->tenor }} bulan</td>
                    <td>{{ $pinjaman->alasan }}</td>
                    <td>
                        @if ($pinjaman->status == 'Menunggu')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif ($pinjaman->status == 'Disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if ($pinjaman->status == 'Menunggu')
                            <a href="/pinjaman/{{ $pinjaman->id }}/approve" class="btn btn-sm btn-success">Approve</a>
                            <a href="/pinjaman/{{ $pinjaman->id }}/reject" class="btn btn-sm btn-danger">Reject</a>
                        @else
                            <span class="text-muted">Selesai</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data pinjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection