@extends('layouts.app')

@section('content')
    @php
        $totalPrice = 0;
    @endphp

    <style>
        @media (max-width: 991.98px) {
            .ringkasan-belanja {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1050;
                background: #fff;
                box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
                padding: 8px;
            }

            body {
                padding-bottom: 230px;
            }

            .ringkasan-belanja .card {
                margin-bottom: 0;
            }

            .ringkasan-belanja .card-body {
                padding: 8px !important;
            }
        }
    </style>



    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Keranjang Saya" />
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('buyer.dashboard')], ['label' => 'Keranjang']]" />

                <div class="row">
                    <div class="col-lg-8 order-2 order-lg-1">
                        @foreach ($groupedCartItems as $sellerId => $items)
                            <div class="card mb-3 p-3">
                                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                                    <div>
                                        <strong>🏪 Kedai
                                            {{ $items->first()->product->user->name ?? 'Unknown Seller' }}</strong>
                                    </div>
                                    <span class="text-success fw-bold">Ready To Buy</span>
                                </div>

                                <div class="card-body p-2">
                                    @foreach ($items as $item)
                                        @php
                                            $subtotal = $item->product->harga * $item->quantity;
                                            $totalPrice += $subtotal;
                                        @endphp
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-center border-bottom py-2 ps-3 gap-2">

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
                                            <div class="flex-grow-1 me-auto">
                                                <div class="fw-semibold text-truncate">{{ $item->product->nama_product }}
                                                </div>
                                                <div class="text-muted small">Rp
                                                    {{ number_format($item->product->harga, 0, ',', '.') }}</div>
                                                <div class="fw-bold small text-danger">
                                                    Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center gap-2" style="min-width: 140px;">
                                                <form action="{{ route('buyer.keranjang.update', $item->id) }}"
                                                    method="POST" class="d-flex">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" min="1"
                                                        value="{{ $item->quantity }}" class="form-control form-control-sm"
                                                        style="width: 70px;" onchange="this.form.submit()">
                                                </form>

                                                <form action="{{ route('buyer.keranjang.destroy', $item->id) }}"
                                                    method="POST">
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

                    <div class="col-lg-4 order-1 order-lg-2 mb-3 ringkasan-belanja">
                        <div class="card p-2">
                            <div class="card-body p-2">
                                <h6 class="fw-bold mb-2 mb-lg-4">Ringkasan Belanja</h6>
                                <div class="d-flex justify-content-between small mb-2">
                                    <span>Total Harga</span>
                                    <span class="fw-bold text-danger fs-6">Rp
                                        {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </div>

                                <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <div class="mb-2 d-flex flex-wrap justify-content-center gap-2 w-100">
                                        <div class="metode mb-2">
                                            <label for="paymentMethod" class="form-label small mb-1">Pembayaran</label>
                                            <select name="payment" id="paymentMethod" class="form-select form-select-sm"
                                                required>
                                                <option disabled>-- Pilih --</option>
                                                <option value="qris">QRIS</option>
                                                <option value="cash">Cash</option>
                                            </select>
                                        </div>
                                        <div class="dine">
                                            <label for="orderType" class="form-label small mb-1">Dine/Takeaway</label>
                                            <select name="dine_option" id="orderType" class="form-select form-select-sm"
                                                required>
                                                <option disabled>-- Pilih --</option>
                                                <option value="dine-in">Dine-in</option>
                                                <option value="takeaway">Takeaway</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 fw-bold mt-3"
                                        style="border-radius: 8px !important;">
                                        Checkout
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
