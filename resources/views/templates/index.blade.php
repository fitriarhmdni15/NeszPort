<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NesZport - Pinjam Alat Olahraga</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/logo.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet" />
</head>
<body id="page-top">
    <!-- Navigation-->
    @include('templates.components.navbar')

    <!-- Kondisi berdasarkan status login -->
    @guest
        <!-- Masthead untuk user yang belum login -->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Website ini merupakan sebuah website peminjaman barang-barang olahraga</div>
                <div class="masthead-heading text-uppercase">Selamat datang di NesZport!</div>
            </div>
        </header>
    @endguest

    @auth
        <!-- Masthead untuk user yang sudah login -->
        @include('templates.components.header')

        <!-- Data Barang-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Daftar Barang Olahraga</h2>
                    <h3 class="section-subheading text-muted">Lihat barang yang ingin kamu pinjam</h3>
                </div>
                <div class="row">
                    @foreach($barang as $item)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Barang -->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal{{ $item->id }}">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_barang }}" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">{{ $item->nama_barang }}</div>
                                <div class="portfolio-caption-subheading text-muted">{{ Str::limit($item->deskripsi, 50) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Barang -->
                    <div class="portfolio-modal modal fade" id="portfolioModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="modal-body">
                                                <!-- Project details -->
                                                <h2 class="text-uppercase">{{ $item->nama_barang }}</h2>
                                                <p class="item-intro text-muted">{{ $item->deskripsi }}</p>
                                                <img class="img-fluid d-block mx-auto" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_barang }}" />
                                                <p>Stok tersedia: <strong>{{ $item->jumlah }}</strong></p>

                                                @if($item->jumlah > 0)
                                                    <button type="button" class="btn btn-success btn-xl text-uppercase" data-bs-toggle="modal" data-bs-target="#pinjamModal{{ $item->id }}">
                                                        Pinjam
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-secondary btn-xl text-uppercase" disabled>
                                                        Stok Habis
                                                    </button>
                                                @endif
                                                <button class="btn btn-danger btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                                    <i class="fas fa-xmark me-1"></i> Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Peminjaman -->
                    <div class="modal fade" id="pinjamModal{{ $item->id }}" tabindex="-1" aria-labelledby="pinjamModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pinjamModalLabel">Pinjam Barang: {{ $item->nama_barang }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('peminjaman.store', $item->id) }}" method="POST">
                                        @csrf
                                        <!-- Nama Peminjam -->
                                        <div class="mb-3">
                                            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                                            <input type="text" class="form-control" id="nama_peminjam" value="{{ auth()->user()->name }}" readonly>
                                        </div>

                                        <!-- Kelas dan Jurusan -->
                                        <div class="mb-3">
                                            <label for="kelas_jurusan" class="form-label">Kelas dan Jurusan</label>
                                            <input type="text" class="form-control" id="kelas_jurusan" value="{{ auth()->user()->kelas }}" readonly>
                                        </div>

                                        <!-- Tanggal dan Waktu Peminjaman -->
                                        <div class="mb-3">
                                            <label for="tanggal_peminjaman" class="form-label">Tanggal dan Waktu Peminjaman</label>
                                            <input type="datetime-local" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
                                        </div>

                                        <!-- Jumlah Peminjaman -->
                                        <label for="jumlah_peminjaman">Jumlah Peminjaman</label>
                                        <input type="number" id="jumlah_peminjaman" name="jumlah_peminjaman" min="1" max="{{ $item->jumlah }}" required>

                                        <button type="submit" class="btn btn-primary">Pinjam</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </section>
    @endauth

    <!-- Footer-->
    @include('templates.components.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/js/script.js') }}"></script>
</body>
</html>
