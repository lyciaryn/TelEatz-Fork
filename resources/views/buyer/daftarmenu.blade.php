@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar />
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Daftar Menu" />

            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $product->nama_product }}</b></h5>
                            <p class="card-text">{{ $product->deskripsi }}</p>
                            <p class="card-text fw-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

                            <div class="d-flex align-items-center justify-content-between">
                                <!-- Lihat Detail Button -->
                                <a href="{{ route('buyer.daftarmenudetail', $product->id) }}" class="btn btn-primary">View</a>
                                <!-- Add to Cart Button -->
                                <form action="{{ route('keranjang.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="addtocart d-flex gap-3">
                                        <button type="submit" class="btn btn-danger flex-shrink-0">Add to Cart</button>
                                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 65px;">

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<x-nav-bottom />
@endsection