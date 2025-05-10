@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar />
            </div>

            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Pesanan Saya" />
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('buyer.dashboard')], ['label' => 'Pesanan Saya']]" />
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Ulasan untuk: {{ $product->nama_product }}</h5>
                        <form action="{{ route('buyer.review.store', ['order' => $order->id, 'product' => $product->id]) }}"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="">Pilih bintang</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }} Bintang</option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Ulasan</label>
                                <textarea name="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-warning text-white fw-bold">Kirim Ulasan</button>
                            <a href="{{ route('buyer.pesanan.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
