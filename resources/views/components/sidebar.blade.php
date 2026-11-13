<aside class="siakad-sidebar">

  <div class="mb-3">
    <h6 class="text-muted text-uppercase small fw-bold">
      Menu Utama
    </h6>
  </div>

  <nav class="nav flex-column gap-1">

    @auth
        <!-- Menu Dashboard: Bisa diakses semua user yang sudah login -->
        <a href="{{ url('/dashboard') }}"
           class="nav-link text-dark rounded">
          <i class="bi bi-speedometer2 me-2"></i>
          Dashboard
        </a>

        <!-- Menu Khusus Admin -->
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('mahasiswa.index') }}"
               class="nav-link text-dark rounded">
              <i class="bi bi-people me-2"></i>
              Mahasiswa
            </a>

            <a href="{{ route('dosen.index') }}"
               class="nav-link text-dark rounded">
              <i class="bi bi-person-badge me-2"></i>
              Data Dosen
            </a>

            <a href="{{ route('mata-kuliah.index') }}"
               class="nav-link text-dark rounded">
              <i class="bi bi-book me-2"></i>
              Mata Kuliah
            </a>

            <a href="{{ route('tahun-akademik.index') }}"
               class="nav-link text-dark rounded">
              <i class="bi bi-calendar3 me-2"></i>
              Tahun Akademik
            </a>

            <a href="{{ route('ruang-kelas.index') }}"
               class="nav-link text-dark rounded">
              <i class="bi bi-building me-2"></i>
              Ruang Kelas
            </a>
        @endif

        <!-- Menu Khusus Dosen -->
        @if (auth()->user()->role === 'dosen')
            <a href="{{ route('dosen.kelas') }}"
               class="nav-link text-dark rounded">
              <i class="bi bi-journal-bookmark me-2"></i>
              Kelas yang Diampu
            </a>
        @endif

        <!-- Menu Khusus Mahasiswa (Silakan di-uncomment jika routenya sudah dibuat nanti) -->
        @if (auth()->user()->role === 'mahasiswa')
            <!-- 
            <a href="#" class="nav-link text-dark rounded">
              <i class="bi bi-calendar-week me-2"></i>
              Jadwal Kuliah
            </a> 
            -->
        @endif

        <hr class="my-2 border-secondary opacity-25">

        <!-- Tombol Logout (Menggunakan form POST sesuai AuthController) -->
        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
            @csrf
            <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start rounded">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </button>
        </form>
    @endauth

  </nav>

</aside>