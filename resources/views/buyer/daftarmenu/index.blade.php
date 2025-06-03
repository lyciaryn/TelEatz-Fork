@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')
@section('content')
    <x-navbarBuyer />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Daftar Menu" />
                <x-breadcrumbs :links="[['label' => 'Home', 'url' => route('buyer.dashboard')], ['label' => 'Daftar Menu']]" />

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
                        {{-- Filter Sorting --}}
                        <div class="mb-3 d-flex flex-wrap gap-2">
                            {{-- Tombol Banyak Dibeli --}}
                            <a href="{{ route('buyer.daftarmenu.index', array_merge(request()->except('sort'), ['sort' => null])) }}"
                                class="badge {{ request('sort') == null ? 'bg-primarys' : 'bg-light text-dark' }} rounded-pill px-3 py-2"
                                style="cursor: pointer; text-decoration: none;">Banyak Dibeli</a>

                            {{-- Tombol Rating Tertinggi --}}
                            <a href="{{ route('buyer.daftarmenu.index', array_merge(request()->query(), ['sort' => 'rating'])) }}"
                                class="badge {{ request('sort') == 'rating' ? 'bg-primarys' : 'bg-light text-dark' }} rounded-pill px-3 py-2"
                                style="cursor: pointer; text-decoration: none;">Rating Tertinggi</a>

                        </div>


                        @forelse ($products as $product)
                            @if (isset($notFound) && $notFound)
                                <div class="alert alert-warning text-center mt-3">
                                    Produk tidak ditemukan untuk kata kunci/kategori yang dipilih.
                                </div>
                            @endif

                            <div class="col-6 col-md-3">
                                <div class="card border border-1 border-light rounded-3 shadow-sm">
                                    @if ($product->img)
                                        <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top"
                                            alt="{{ Str::limit($product->nama_product, 4) }}" style="height: 135px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white text-uppercase fw-bold text-center px-2"
                                            style="height: 135px; word-wrap: break-word; white-space: normal;">
                                            {{ Str::limit($product->nama_product, 36) }}
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

                                            <h6 class="card-title d-flex-md flex-column align-items-start justify-content-start">
                                                <b>{{ Str::limit($product->nama_product, 36) }}</b>

                                                <div class="d-flex justify-content-start align-items-end">
                                                    @if ($product->order_items_count == null)
                                                        <span style="font-size: 11px; background-color: var(--grey)" class="badge small">
                                                            0x dibeli
                                                        </span>
                                                    @else
                                                        <span style="font-size: 11px; background-color: var(--primary)" class="badge small">
                                                            {{ $product->order_items_count }}x dibeli
                                                        </span>
                                                    @endif
                                                </div>
                                            </h6>


                                        </a>
                                        <p class="text-secondary fw-bold opacity-75" style="font-size: 11px;">Kedai
                                            {{ $product->user?->name ?? '-' }} 🏪</p>
                                        <p class="mb-2">
                                            @if ($product->user)
                                                <span
                                                    class="badge {{ $product->user?->is_open ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $product->user?->is_open ? 'Open' : 'Tutup' }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Status Tidak Diketahui</span>
                                            @endif
                                        </p>
                                        <p class="mb-2">
                                            @php
                                                $averageRating = $product->reviews->avg('rating');
                                                $roundedRating = round($averageRating);
                                            @endphp

                                            @if ($product->reviews->count() > 0)
                                                <div class="text-warning my-1">
                                                    {!! str_repeat('★', $roundedRating) . str_repeat('☆', 5 - $roundedRating) !!}
                                                    <small
                                                        class="text-muted">({{ number_format($averageRating, 1) }}/5)</small>
                                                </div>
                                            @else
                                                <div class="text-muted my-1">
                                                    ~
                                                </div>
                                            @endif
                                        </p>
                                        </p>
                                        <p>{{ Str::limit($product->deskripsi, 36) }}</p>
                                        <h6 class="card-text fw-bold mt-1 mb-2 text-danger mt-2 mb-2">Rp
                                            {{ number_format($product->harga, 0, ',', '.') }}</h6>
                                        <div class="cart-section d-flex align-items-center justify-content-end">
                                            <form action="{{ route('buyer.keranjang.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="addtocart d-flex gap-2 align-items-center justify-content-end">
                                                    <input type="number" name="quantity" value="1" min="1"
                                                        class="form-control" style="width: 65px;"
                                                        {{ $product->user?->is_open ? '' : 'disabled' }}>

                                                    @if ($product->user?->is_open == 1)
                                                        <button type="submit" class="btn btn-warning"
                                                            title="{{ $product->user?->is_open ? 'Tambah ke keranjang' : 'Toko sedang tutup' }}">
                                                            <i class='bx bxs-cart-add fs-5 mt-1 text-white'></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-secondary disabled"
                                                            title="{{ $product->user?->is_open ? 'Tambah ke keranjang' : 'Toko sedang tutup' }}">
                                                            <i class='bx bxs-cart-add fs-5 mt-1 text-white'></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @empty
                            {{-- Tampilkan jika tidak ada item dalam keranjang --}}
                            <div class="card text-center animate_animated animate_fadeInUp" style="border-radius: 50px;">
                                <div
                                    class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                                    <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200"
                                        alt="">
                                    <h2 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Halaman Daftar Menu</h2>
                                    <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Maaf ya, makanan
                                        sedang
                                        tidak tersedia 😭​</small>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                {{-- PEMBUNGKUS CONTENT --}}

            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
