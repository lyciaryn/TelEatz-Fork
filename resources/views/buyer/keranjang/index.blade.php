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
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('buyer.dashboard')], ['label' => 'Keranjang']]" />


                @foreach ($groupedCartItems as $sellerId => $items)
                    <div class="card mb-3 p-3">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between">
                            <div>

                                <strong>🏪 Kedai {{ $items->first()->product->user->name ?? 'Unknown Seller' }}</strong>
                            </div>
                            <span class="text-success fw-bold">Ready To Buy</span>
                        </div>

                        <div class="card-body p-2">
                            @foreach ($items as $item)
                                <div class="d-flex align-items-center border-bottom py-2 ps-3">


                                    @if ($item->product->img)
                                        <img src="{{ asset('images/' . $item->product->img) }}" class="rounded"
                                            alt="{{ $item->product->img }}"
                                            style="width: 80px; height: 80px; object-fit: cover; margin-right: 10px;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                            style="width: 80px; height: 80px; margin-right: 10px; font-size:10px;">
                                            {{ $item->product->nama_product }}
                                        </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-truncate">{{ $item->product->nama_product }}</div>
                                        <div class="text-muted small">Rp
                                            {{ number_format($item->product->harga, 0, ',', '.') }}</div>

                                        <div class="fw-bold small text-danger">
                                            Subtotal: Rp
                                            {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}
                                        </div>
                                    </div>


                                    <div class="d-flex align-items-center gap-2" style="min-width: 140px;">

                                        <form action="{{ route('buyer.keranjang.update', $item->id) }}" method="POST"
                                            class="d-flex">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" min="1"
                                                value="{{ $item->quantity }}" class="form-control form-control-sm"
                                                style="width: 70px;" onchange="this.form.submit()">

                                        </form>

                                        <form action="{{ route('buyer.keranjang.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
