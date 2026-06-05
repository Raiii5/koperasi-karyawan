@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Data Karyawan</h2>
    <a href="/karyawan/create" class="btn btn-primary">+ Tambah Karyawan</a>
</div>

<div class="table-card">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($karyawans as $karyawan)
                <tr>
                    <td>{{ $karyawan->id }}</td>
                    <td>{{ $karyawan->nik }}</td>
                    <td class="fw-semibold">{{ $karyawan->nama }}</td>
                    <td>{{ $karyawan->divisi }}</td>
                    <td>{{ $karyawan->jabatan }}</td>
                    <td>
                        <span class="badge bg-success">{{ $karyawan->status }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data karyawan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection