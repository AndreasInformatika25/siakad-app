@extends('layouts.app')
@section('title', 'Tambah Tahun Akademik')

@extends('layouts.app')
@section('title', 'Tambah Tahun Akademik') {{-- Ganti judul sesuai halamannya --}}

@section('content')
<div class="container-fluid py-4 px-4">
    <!-- Header Halaman ala Dosen (Tanpa Card Header) -->
    <div class="mb-4">
        <h2 class="mb-2">Tambah Tahun Akademik</h2>
        <p class="text-muted mb-0">Tambahkan data tahun akademik baru ke dalam sistem.</p>
    </div>

    <!-- Card putih dengan shadow-sm persis seperti form Dosen -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            
            <form action="{{ route('tahun-akademik.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Akademik <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun') }}" placeholder="Contoh: 2026/2027" maxlength="9" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                    <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester" required>
                        <option value="">-- Pilih Semester --</option>
                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <!-- Nilai checkbox ini 1 kalau dicentang -->
                    <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Jadikan Tahun Akademik Aktif</label>
                    <small class="d-block text-muted">Jika dicentang, tahun akademik lain yang saat ini aktif akan otomatis lengser dan menjadi tidak aktif.</small>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="{{ route('tahun-akademik.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Tahun Akademik</h6>
        </div>
        <div class="card-body">
            <!-- Form mengarah ke route store dengan method POST -->
            
        </div>
    </div>
</div>
@endsection