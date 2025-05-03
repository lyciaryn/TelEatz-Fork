@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar />
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Daftar Menu Detail" />
            <x-breadcrumbs :links="[
                ['label' => 'Dashboard', 'url' => route('buyer.dashboard')],
                ['label' => 'Daftar Menu', 'url' => route('buyer.daftarmenu.index')],
                ['label' => 'Detail'] {{-- label terakhir manual, bebas mau 'Detail', 'Data', dst --}}
            ]" />
            <h1 class="mb-4">{{ $product->nama }}</h1>

            @if($product->gambar)
            <img src="{{ asset('storage/' . $product->gambar) }}" class="img-fluid mb-3" alt="{{ $product->nama }}">
            @endif

            <p class="fw-bold">Harga: Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            <p>Deskripsi: {{ $product->deskripsi }}</p>
            <p>Kategori: {{ $product->category->nama_kategori ?? '-' }}</p>
            <p>Penjual: {{ $product->user?->name ?? '-' }} </p>

            <a href="{{ route('buyer.daftarmenu.index') }}" class="btn btn-secondary mt-3">Kembali ke daftar makanan</a>


        </div>
    </div>
</div>
<x-nav-bottom />
@endsection
