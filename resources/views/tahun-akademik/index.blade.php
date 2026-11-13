@extends('layouts.app')

@section('title', 'Data Tahun Akademik')

@push('styles')
    <!-- CSS DataTables versi 3.1.4 agar UI sejajar dan rapi seperti template dosen -->
    <link rel="stylesheet" href="https://cdn.datatables.net/3.1.4/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="container-fluid py-4 px-4">
    <!-- Header selaras dengan gaya dosen -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-2">Data Tahun Akademik</h2>
            <p class="text-muted mb-0">Daftar periode tahun akademik sistem</p>
        </div>
        <a href="{{ route('tahun-akademik.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Tambah Data
        </a>
    </div>

    <!-- Alert notifikasi sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelTahunAkademik" class="table table-bordered table-striped table-hover align-middle mb-0 w-100">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No.</th>
                            <th>Tahun</th>
                            <th>Semester</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahunAkademik as $ta)
                        <tr>
                            <!-- Dikosongkan agar diisi otomatis oleh drawCallback DataTables -->
                            <td></td>
                            <td>{{ $ta->tahun }}</td>
                            <td>{{ $ta->semester }}</td>
                            <td>{{ $ta->tanggal_mulai }}</td>
                            <td>{{ $ta->tanggal_selesai }}</td>
                            <td>
                                @if($ta->status)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('tahun-akademik.edit', $ta->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tahun-akademik.destroy', $ta->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data ini?')">
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
    <!-- Script DataTables versi 3.1.4 dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/3.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/3.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        $(function () {
            $('#tabelTahunAkademik').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                order: [[1, 'desc']], // Default sorting: urutkan dari tahun terbaru
                columnDefs: [
                    { targets: [0, 6], orderable: false, searchable: false }
                ],
                // Fitur autonumbering DataTables (selaras dengan script dosen)
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