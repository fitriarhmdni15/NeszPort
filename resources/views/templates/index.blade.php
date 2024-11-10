<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NesZport - Pinjam Alat Olahraga</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('template/logo.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet" />
</head>
<body id="page-top">
    <!-- Navigation-->
    @include('templates.components.navbar')
    <!-- Masthead-->
    @include('templates.components.header')

    <!-- Portfolio Grid-->
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
                            <!-- Menampilkan gambar barang -->
                            <img class="img-fluid" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_barang }}" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">{{ $item->nama_barang }}</div>
                            <div class="portfolio-caption-subheading text-muted">{{ Str::limit($item->deskripsi, 50) }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Modals -->
    @foreach($barang as $item)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="{{ asset('template/close-icon.svg') }}" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details -->
                                <h2 class="text-uppercase">{{ $item->nama_barang }}</h2>
                                <p class="item-intro text-muted">{{ $item->deskripsi }}</p>
                                <!-- Menampilkan gambar barang di modal -->
                                <img class="img-fluid d-block mx-auto" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_barang }}" />
                                <p>Stok tersedia: <strong>{{ $item->jumlah }}</strong></p>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Footer-->
    @include('templates.components.footer')

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('template/js/script.js') }}"></script>
</body>
</html>
