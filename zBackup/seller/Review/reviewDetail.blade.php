@php
    use Illuminate\Support\Str; 
@endphp
@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_seller />
            </div>
            
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Ulasan Untuk {{$product->nama_product}}" />
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('seller.dashboard')], ['label' => 'Ulasan', 'url' => route('seller.review')], ['label'=>'Detail Ulasan']]" />
                
                {{-- ================== PESANAN LOOP ================== --}}
                <div class="card mb-3 p-3">
                    {{-- ========== HEADER PESANAN ========== --}}
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <div>
                        <strong>
                            {{ ucwords(strtolower(string: $product->nama_product)) ?? 'Tidak Diketahui'}}
                        </strong>
                        <br>
                        <br>
                            <small class="text-muted"><b>Id Produk: {{ $product->id }}</b></small><br>
                            <small class="text-muted">Tanggal: {{ $product->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>

                    {{-- ========== BODY PESANAN ========== --}}
                    <div class="card-body p-2">
                        {{-- ========== ITEM PERTAMA ========== --}}
                        <div class="d-flex flex-wrap justify-content-between align-items-center py-2 ps-3 gap-2">
                            @if ($product->img)
                                <img src="{{ asset('images/' . $product->img) }}" class="rounded"
                                    style="width: 80px; height: 80px; margin-right: 10px; object-fit: cover;">
                            @else
                            <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                style="width: 80px; height: 80px; margin-right: 10px; font-size:10px;">
                                {{ $product->nama_product }}
                            </div>
                            @endif

                            <div class="flex-grow-1 me-auto">
                                <div class="fw-semibold text-truncate">{{ $product->nama_product }}</div>
                                <div class="text-muted small">
                                    Harga: Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </div>
                                <div class="text-muted small">Deskripsi: {{ str::limit($product->deskripsi, 40) }}</div>
                                <div class="fw-bold small text-danger">
                                    Total Review: {{ $product->reviews ? $product->reviews->count() : 0 }}
                                </div>
                            </div>

                            <div class="text-end">
                                <span class="text-dark opacity-50">{{ ucfirst($product->payment) }}</span><br>
                                <span
                                    class="text-dark mt-1 opacity-50">{{ ucfirst($product->dine_option) }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center align-items-center mt-3 text-dark mt-1 opacity-50 fw-bold">Ulasan Pembeli</div>
                        <div class="card mb-3 p-3">                                       
                            {{-- Konten Review --}}
                            {{-- Komentar dan Rating --}}
                            <div class="card shadow-sm mt-4">
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
                                                    Dibeli pada {{ $review->created_at }}
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
                            <hr class="mx-auto" style="opacity: 30%; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection