@extends('layouts.app')

@section('content')
@php
$title = 'Produk Saya';
@endphp
    <x-navbar_seller />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_seller />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Kelola Makanan" />
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('seller.dashboard')], ['label' => 'Kelola Makanan']]" />
                <div><a href="{{ route('kelolamakanan.create') }}" class="btn btn-primary w-100">Tambah Makanan</a></div>
                
                <div class="card p-3 mb-4 shadow-sm">
                    <form method="GET" action="{{ route('kelolamakanan') }}">
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
                </div>
                
                <!-- Check jika ada data makanan -->
                @if ($makanan->isEmpty())
                    <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
                        <div
                            class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                            <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200" alt="">
                            <h2 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Halaman Kelola Makanan</h2>
                            <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Sepertinya Kamu Belum
                                Menambahkan Apapun</small>
                        </div>
                    </div>
                @else
                    <!-- Loop untuk menampilkan makanan dalam card -->
                    <div class="row">
                        @foreach ($makanan as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 d-flex flex-column">
                                    
                                    @if($item->img)
                                        <img src="{{ asset('images/' . $item->img) }}" class="card-img-top" style="height: 135px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-success text-white text-uppercase fw-bold" style="height: 135px;">
                                            {{ $item->nama_product }}
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h4 class="card-title" style="font-weight: bold; !important">
                                            {{ $item->nama_product }}
                                        </h4>
                                        <label for="Harga">Harga</label>
                                        <p class="card-text">Rp.{{ number_format($item->harga, 0, ',', '.') }}</p>
                                        <br>
                                        <label for="deskripsi">Deskripsi</label>
                                        <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}...</p>
                                        <br>
                                        <label for="kategori">Kategori</label>
                                        <p class="card-text">{{ $item->category->nama_kategori }}</p>
                                        <br>
                                        <label for="ketersediaan">Ketersediaan</label>
                                        <p class="card-text">{{ $item->is_avaialable == 1 ? 'Tidak Tersedia' : 'Tersedia' }}
                                        </p> <br>

                                        <!-- Tombol di bawah -->
                                        <div class="mt-auto d-flex justify-content-around align-items-center"
                                            style="box-shadow: none !important;">
                                            <a href="{{ route('kelolamakanan.showdetail', $item->id) }}"
                                                class="btn btn-primary d-flex align-items-center justify-content-center" style="height: 40px;">Detail</a>
                                            <a href="{{ route('kelolamakanan.edit', $item->id) }}"
                                                class="btn btn-primary d-flex align-items-center justify-content-center mx-1" style="height: 40px;">Edit</a>
                                            <form id="deleteForm{{ $item->id }}"
                                                action="{{ route('kelolamakanan.softdelete', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger w-100" style="height: 40px;"
                                                    onclick="confirmDelete({{ $item->id }})">Delete</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-nav-bottom_seller />
@endsection
