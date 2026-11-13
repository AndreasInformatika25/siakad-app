@extends('layouts.app')
@section('title', 'Tambah Ruang Kelas')

@section('content')
<div class="container-fluid py-4 px-4">
    <!-- Header Halaman ala Dosen (Tanpa Card Header) -->
    <div class="mb-4">
        <h2 class="mb-2">Tambah Ruang Kelas</h2>
        <p class="text-muted mb-0">Tambahkan data ruang kelas baru ke dalam sistem.</p>
    </div>

    <!-- Card putih dengan shadow-sm persis seperti form Dosen -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('ruang-kelas.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode_ruang" class="form-label">Kode Ruang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_ruang') is-invalid @enderror" id="kode_ruang" name="kode_ruang" value="{{ old('kode_ruang') }}" maxlength="20" required>
                        @error('kode_ruang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama_ruang" class="form-label">Nama Ruang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_ruang') is-invalid @enderror" id="nama_ruang" name="nama_ruang" value="{{ old('nama_ruang') }}" maxlength="100" required>
                        @error('nama_ruang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="gedung" class="form-label">Gedung <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('gedung') is-invalid @enderror" id="gedung" name="gedung" value="{{ old('gedung') }}" maxlength="100" required>
                        @error('gedung') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kapasitas" class="form-label">Kapasitas <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" min="1" required>
                        @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jenis_ruang" class="form-label">Jenis Ruang <span class="text-danger">*</span></label>
                    <select class="form-select @error('jenis_ruang') is-invalid @enderror" id="jenis_ruang" name="jenis_ruang" required>
                        <option value="">-- Pilih Jenis Ruang --</option>
                        <option value="Teori" {{ old('jenis_ruang') == 'Teori' ? 'selected' : '' }}>Teori</option>
                        <option value="Laboratorium" {{ old('jenis_ruang') == 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                        <option value="Seminar" {{ old('jenis_ruang') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                    </select>
                    @error('jenis_ruang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Ruangan Tersedia / Dapat Digunakan</label>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="{{ route('ruang-kelas.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection