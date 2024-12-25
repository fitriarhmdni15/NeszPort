@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Barang</h2>
    <a href="{{ route('admin.data_barang') }}" class="btn btn-secondary mb-3">Kembali ke Data Barang</a>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>{{ $barang->nama_barang }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img-fluid rounded">
                </div>
                <div class="col-md-8">
                    <p><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
                    <p><strong>Jumlah:</strong> {{ $barang->jumlah }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
