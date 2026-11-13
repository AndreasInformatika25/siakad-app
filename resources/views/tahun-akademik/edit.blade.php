@extends('layouts.app')
@section('title', 'Edit Tahun Akademik')

@section('content')
<div class="container-fluid py-4 px-4">
    <!-- Header Halaman ala Dosen (Tanpa Card Header) -->
    <div class="mb-4">
        <h2 class="mb-2">Edit Tahun Akademik</h2>
        <p class="text-muted mb-0">Perbarui informasi tahun akademik yang telah tersimpan.</p>
    </div>

    <!-- Card putih dengan shadow-sm persis seperti form Dosen -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            
            <form action="{{ route('tahun-akademik.update', $tahunAkademik->id) }}" method="POST">
                @csrf
                <!-- Wajib pakai PUT untuk proses update data di Laravel -->
                @method('PUT')
                
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Akademik <span class="text-danger">*</span></label>
                    <!-- old('tahun', $tahunAkademik->tahun) berarti: prioritasin inputan user kalau gagal validasi, kalau belum ada tampilin data dari database -->
                    <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun', $tahunAkademik->tahun) }}" placeholder="Contoh: 2026/2027" maxlength="9" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                    <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester" required>
                        <option value="">-- Pilih Semester --</option>
                        <option value="Ganjil" {{ old('semester', $tahunAkademik->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester', $tahunAkademik->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $tahunAkademik->tanggal_mulai) }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $tahunAkademik->tanggal_selesai) }}" required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', $tahunAkademik->status) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Jadikan Tahun Akademik Aktif</label>
                    <small class="d-block text-muted">Jika dicentang, tahun akademik lain yang saat ini aktif akan otomatis lengser dan digantikan oleh ini.</small>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Data</button>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Tahun Akademik</h6>
        </div>
        <div class="card-body">
            <!-- Action mengarah ke route update dan membawa ID data yang mau diedit -->
            
        </div>
    </div>
</div>
@endsection