@php use Illuminate\Support\Str; @endphp

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
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('buyer.dashboard')], ['label' => 'Daftar Menu']]" />

                {{-- PEMBUNGKUS CONTENT --}}
                <div class="card p-3 mb-4 shadow-sm">

                    <form method="GET" action="{{ route('buyer.daftarmenu.index') }}">
                        <div class="row align-items-end mb-4 g-2">
                            {{-- Input Search --}}
                            <div class="col-12 col-md-4">
                                <label for="search" class="form-label" style="font-size: 14px;">Cari Menu</label>
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="🔍   Cari nama menu atau toko..." value="{{ request('search') }}"
                                    style="font-size: 14px;">
                            </div>

                            {{-- Tombol Search --}}
                            <div class="col-12 col-md-2 d-grid">
                                <button type="submit" name="search_button" value="1"
                                    class="btn btn-primary d-flex justify-content-center align-items-center"
                                    style="border-radius: 8px !important; box-shadow:none !important">
                                    <i class='bx bx-search me-1'></i>
                                    <span style="font-size: 14px;">Search</span>
                                </button>
                            </div>

                            {{-- Select Filter --}}
                            <div class="col-12 col-md-4">
                                <label for="category" class="form-label" style="font-size: 14px;">Kategori</label>
                                <select name="category" id="category" class="form-select"
                                    style="font-size: 14px; background-color: #fcfeff;">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->nama_kategori }}"
                                            {{ request('category') == $cat->nama_kategori ? 'selected' : '' }}>
                                            {{ $cat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tombol Filter --}}
                            <div class="col-12 col-md-2 d-grid">
                                <button type="submit" name="filter_button" value="1"
                                    class="btn btn-success d-flex justify-content-center align-items-center">
                                    <i class='bx bx-filter-alt me-1'></i>
                                    <span style="font-size: 14px;">Filter</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- FILTER --}}

                    <div class="row g-2 mt-2"> <!-- g-0 = no gutter -->

                        @foreach ($products as $product)
                            <div class="col-6 col-md-3">
                                <div class="card border border-1 border-light rounded-3 shadow-sm">
                                    @if ($product->img)
                                        <img src="{{ asset('images/' . $product->img) }}" class="card-img-top"
                                            alt="{{ $product->nama }}" style="height: 135px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white text-uppercase fw-bold"
                                            style="height: 135px;">
                                            {{ $product->nama_product }}
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <a class="link-primary link-offset-2" style="text-decoration: none;"
                                            href="{{ route('buyer.daftarmenu.show', $product->id) }}">
                                            <p class="mb-2">
                                                <span class="badge bg-secondary rounded-pill px-2 py-1"
                                                    style="font-size: 9px;">
                                                    {{ $product->category?->nama_kategori ?? '-' }}
                                                </span>
                                            </p>

                                            <h6 class="card-title"><b>{{ $product->nama_product }}</b></h6>
                                        </a>
                                        <p class="text-secondary mb-2 fw-bold opacity-75" style="font-size: 11px;">Kedai
                                            {{ $product->user?->name ?? '-' }} 🏪</p>
                                        </p>
                                        <p>{{ Str::limit($product->deskripsi, 36) }}</p>
                                        <h6 class="card-text fw-bold mt-1 mb-2 text-danger mt-2 mb-2">Rp
                                            {{ number_format($product->harga, 0, ',', '.') }}</h6>

                                        <div class=" cart-section d-flex align-items-center justify-content-end">
                                            <form action="{{ route('buyer.keranjang.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="addtocart d-flex gap-2 align-items-center justify-content-end">
                                                    <input type="number" name="quantity" value="1" min="1"
                                                        class="form-control" style="width: 65px;">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class='bx bxs-cart-add fs-5 mt-1 text-white'></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- PEMBUNGKUS CONTENT --}}

            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
