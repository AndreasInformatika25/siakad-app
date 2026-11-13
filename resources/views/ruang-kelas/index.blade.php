@extends('layouts.app')

@section('title', 'Data Ruang Kelas')

@push('styles')
    <!-- Pakai versi CSS DataTables yang sama dengan dosen -->
    <link rel="stylesheet" href="https://cdn.datatables.net/3.1.4/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-2">Data Ruang Kelas</h2>
            <p class="text-muted mb-0">Daftar ruang kelas yang tersedia</p>
        </div>
        <a href="{{ route('ruang-kelas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Tambah Ruang Kelas
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelRuangKelas" class="table table-bordered table-striped table-hover align-middle mb-0 w-100">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No.</th>
                            <th>Kode Ruang</th>
                            <th>Nama Ruang</th>
                            <th>Gedung</th>
                            <th width="100">Kapasitas</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangKelas as $rk)
                            <tr>
                                <!-- Kosongkan kolom nomor, biar diisi otomatis sama DataTables drawCallback -->
                                <td></td>
                                <td>{{ $rk->kode_ruang }}</td>
                                <td>{{ $rk->nama_ruang }}</td>
                                <td>{{ $rk->gedung }}</td>
                                <td>{{ $rk->kapasitas }}</td>
                                <td>{{ $rk->jenis_ruang }}</td>
                                <td>
                                    @if($rk->status)
                                        <span class="badge bg-success">Tersedia</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('ruang-kelas.edit', $rk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('ruang-kelas.destroy', $rk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ruang kelas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!-- Wajib load script dari CDN persis punya dosen -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/3.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/3.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        $(function () {
            $('#tabelRuangKelas').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100], // Menyesuaikan opsi dropdown
                order: [[1, 'asc']], // Sort berdasarkan Kode Ruang
                columnDefs: [
                    // Kolom index 0 (No) dan 7 (Aksi) di-disable sorting-nya
                    { targets: [0, 7], orderable: false, searchable: false }
                ],
                // Fitur autonumbering bawaan DataTables ala kodingan dosen
                drawCallback: function () {
                    const api = this.api();
                    const pageInfo = api.page.info();
                    api.column(0, { page: 'current' }).nodes().each(function (cell, index) {
                        cell.textContent = pageInfo.start + index + 1;
                    });
                }
            });
        });
    </script>
@endpush