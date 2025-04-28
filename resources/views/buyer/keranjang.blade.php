@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar />
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Keranjang Saya" />

            @foreach($groupedCartItems as $sellerId => $items)
            <div class="card mb-4">
                <div class="card-header">
                    Penjual: {{ $items->first()->product->user->name ?? 'Unknown Seller' }}
                </div>
                <div class="card-body">
                    @foreach($items as $item)
                    <div class="mb-3">
                        <h5><b>{{ $item->product->nama_product }}</b></h5>
                        <p>Harga/product: Rp {{ number_format($item->product->harga, 0, ',', '.') }}</p>
                        <p>Quantity: {{ $item->quantity }}</p>
                        <p><b>Subtotal: Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</b></p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach


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