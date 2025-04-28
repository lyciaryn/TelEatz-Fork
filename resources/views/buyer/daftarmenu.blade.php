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
                            <a href="{{ route('buyer.daftarmenudetail', $product->id) }}" class="btn btn-primary mt-3">Lihat Detail</a>
                            <a href="" class="btn btn-warning mt-3 ms-3">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
                <div class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                    <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200" alt="">
                    <h2 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Halaman Daftar Menu</h2>
                    <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Sepertinya kamu belum Belanja apapun</small>
                </div>
            </div> -->
        </div>
    </div>
</div>
<x-nav-bottom />
@endsection