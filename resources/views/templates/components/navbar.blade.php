<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #ff9f1c; z-index: 1050;" id="mainNav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Data Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peminjaman.history') }}">Riwayat Peminjaman</a> 
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link text-white text-uppercase" style="text-decoration: none;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Tambahkan padding-top pada konten -->
<div class="container mt-5">
    <!-- Konten lainnya di sini -->
</div>
