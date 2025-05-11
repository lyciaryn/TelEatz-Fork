@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_seller />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Kelola Makanan" />
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('seller.dashboard')], ['label'=>'Ulasan']]" />

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
                                        <img src="{{ asset('images/' . $item->img) }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 135px; object-fit: cover;">
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
                                        <p class="card-text">{{ $item->is_avaialable == 1 ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </p> <br>

                                        <!-- Tombol di bawah -->
                                        <div class="mt-auto d-flex justify-content-around"
                                            style="box-shadow: none !important;">
                                            <a href="{{ route('seller.review.show', $item->id) }}"
                                                class="btn btn-primary w-100">Lihat Review</a>
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
    <x-nav-bottom />
@endsection
