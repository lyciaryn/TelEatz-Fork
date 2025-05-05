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
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('buyer.dashboard')], ['label' => 'Pesanan Saya']]" />


                @forelse($orders as $order)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <strong>Order ID: {{ $order->id }}</strong><br>
                                Tanggal: {{ $order->created_at->format('d M Y, H:i') }}
                            </div>
                            <div class="text-end">
                                <strong>Status:</strong> {{ $order->status }}
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($order->order_items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $item->product->nama_product ?? 'Produk tidak ditemukan' }}</strong><br>
                                            <small>Harga: Rp {{ number_format($item->price, 0, ',', '.') }} x
                                                {{ $item->quantity }}</small>
                                        </div>
                                        <div>
                                            <strong>Subtotal:</strong><br>
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-end mt-3 fw-bold">
                                Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada pesanan ditemukan.</p>
                @endforelse


            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
