@extends('layouts.app')

@section('content')
    <x-navbarBuyer />

    <div class="container my-5">
        <div class="row dash">
            <div class="col-lg-3 pos mb-4 mb-lg-0">
                <x-sidebar />
            </div>

            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Detail Makanan" />
                <x-breadcrumbs :links="[
                    ['label' => 'Home', 'url' => route('buyer.dashboard')],
                    ['label' => 'Daftar Menu', 'url' => route('buyer.daftarmenu.index')],
                    ['label' => 'Detail'],
                ]" />

                {{-- DETAIL PRODUK --}}
                <div class="card shadow-sm">
                    {{-- Gambar --}}
                    @if ($product->img)
                        <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->nama }}"
                            style="height: 400px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white text-uppercase fw-bold"
                            style="height: 400px;">
                            {{ $product->nama_product }}
                        </div>
                    @endif

                    {{-- Isi detail --}}
                    <div class="card-body">
                        <h3 class="card-title fw-bold">{{ $product->nama_product }}</h3>
                        <h5 class="text-danger fw-semibold">Rp {{ number_format($product->harga, 0, ',', '.') }}</h5>

                        <p class="mb-2">
                            @php
                                $averageRating = $product->reviews->avg('rating');
                                $roundedRating = round($averageRating);
                            @endphp

                            @if ($product->reviews->count() > 0)
                                <div class="text-warning my-1">
                                    {!! str_repeat('★', $roundedRating) . str_repeat('☆', 5 - $roundedRating) !!}
                                    <small class="text-muted">({{ number_format($averageRating, 1) }}/5)</small>
                                </div>
                            @else
                                <div class="text-muted my-1">
                                    ~
                                </div>
                            @endif
                        </p>

                        <p class="mt-3"><strong>Deskripsi:</strong><br> {{ $product->deskripsi ?? '-' }}</p>
                        <p><strong>Kategori:</strong> {{ $product->category->nama_kategori ?? '-' }}</p>
                        <p><strong>Penjual:</strong> {{ $product->user?->name ?? '-' }}</p>
                        <a href="{{ route('buyer.daftarmenu.index') }}" class="btn btn-secondary mt-3">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke daftar makanan
                        </a>
                    </div>
                </div>

                {{-- ULASAN DUMMY --}}
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-light fw-bold">
                        Ulasan Pembeli
                    </div>
                    <div class="card-body">

                        @forelse ($product->reviews as $review)
                            <div class="d-flex align-items-start gap-3 mb-4">
                                {{-- Foto Profil --}}
                                @if ($review->buyer && $review->buyer->profile_picture)
                                    <img class="rounded-circle img-thumbnail shadow-sm"
                                        src="{{ asset('storage/profile_pictures/' . $review->buyer->profile_picture) }}"
                                        alt="Profil {{ $review->buyer->name }}"
                                        style="width: 50px; height: 50px; object-fit: cover; aspect-ratio: 1 / 1;">
                                @else
                                    <div class="rounded-circle img-thumbnail shadow-sm d-flex justify-content-center align-items-center"
                                        style="width: 50px; height: 50px; aspect-ratio: 1 / 1; background-color: #369a74;">
                                        <span class="text-light" style="font-size: 18px;">
                                            {{ strtoupper(substr($review->buyer->name, 0, 1)) .
                                                strtoupper(substr($review->buyer->name, strpos($review->buyer->name, ' ') + 1, 1)) }}
                                        </span>
                                    </div>
                                @endif

                                {{-- ULASAN --}}
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6
                                            class="mb-1 fw-bold
                                            {{ auth()->id() === $review->buyer_id ? 'text-danger' : '' }}">
                                            {{ auth()->id() === $review->buyer_id ? 'You' : $review->buyer->name }}
                                        </h6>


                                        @if (auth()->id() === $review->buyer_id)
                                            <form method="POST" action="{{ route('buyer.review.destroy', $review->id) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <small class="text-muted">
                                        Dibeli pada {{ $review->created_at->format('d M Y') }}
                                        • <strong>{{ $product->nama_product }}</strong>
                                    </small>
                                    <div class="text-warning my-1">
                                        {!! str_repeat('★', $review->rating) . str_repeat('☆', 5 - $review->rating) !!}
                                    </div>
                                    <p class="mb-0" style="word-break: break-word; overflow-wrap: anywhere;">
                                        {{ $review->comment }}
                                    </p>


                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
                        @endforelse

                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-nav-bottom />
@endsection
