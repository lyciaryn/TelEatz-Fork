@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_seller />
            </div>

            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Pesanan Saya" />
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('seller.dashboard')], ['label' => 'History']]" />

                {{-- ================== PESANAN LOOP ================== --}}
                @forelse($pesanan as $order)
                    <div class="card mb-3 p-3">
                        {{-- ========== HEADER PESANAN ========== --}}
                        <div class="card-header bg-white d-flex align-items-center justify-content-between">
                            <div>
                            <strong>
                                {{ ucwords(strtolower($order->buyer->name)) ?? 'Tidak Diketahui'}}
                            </strong>
                            <br>
                            <br>
                                <small class="text-muted"><b>Id Pesanan: {{ $order->id }}</b></small><br>
                                <small class="text-muted">Tanggal: {{ $order->created_at }}</small>
                            </div>
                            <span class="fw-bold text-{{ $order->status === 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        {{-- ========== BODY PESANAN ========== --}}
                        <div class="card-body p-2">
                            @php
                                $items = $order->orderItems;
                                $collapseId = 'orderCollapse' . $order->id;
                            @endphp

                            {{-- ========== ITEM PERTAMA ========== --}}
                            @foreach ($items as $i => $item)
                                @php
                                    $subtotal = $item->product->harga * $item->quantity;
                                @endphp

                                @if ($i === 0)
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center py-2 ps-3 gap-2">
                                        @if ($item->product->img)
                                            <img src="{{ asset('images/' . $item->product->img) }}" class="rounded"
                                                style="width: 80px; height: 80px; object-fit: cover; margin-right: 10px;">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                                style="width: 80px; height: 80px; margin-right: 10px; font-size:10px;">
                                                {{ $item->product->nama_product }}
                                            </div>
                                        @endif

                                        <div class="flex-grow-1 me-auto">
                                            <div class="fw-semibold text-truncate">{{ $item->product->nama_product }}</div>
                                            <div class="text-muted small">
                                                Harga: Rp {{ number_format($item->product->harga, 0, ',', '.') }} x
                                                {{ $item->quantity }}
                                            </div>
                                            <div class="fw-bold small text-danger">
                                                Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <span class="text-dark opacity-50">{{ ucfirst($order->payment) }}</span><br>
                                            <span
                                                class="text-dark mt-1 opacity-50">{{ ucfirst($order->dine_option) }}</span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center mt-3 text-dark mt-1 opacity-50">Review:</div>
                                    <div class="text-dark mt-1 opacity-50 ps-3">
                                        {{ $item->review ? $item->review->comment : 'Pembeli Belum Memberikan Ulasan' }} <hr>
                                    </div>

                                @elseif ($i === 1)
                                    {{-- ========== COLLAPSE START ========== --}}
                                    <div class="collapse mt-2" id="{{ $collapseId }}">
                                @endif

                                {{-- ========== ITEM SELAIN PERTAMA ========== --}}
                                @if ($i > 0)
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center py-2 ps-3 gap-2">
                                        @if ($item->product->img)
                                            <img src="{{ asset('images/' . $item->product->img) }}" class="rounded"
                                                style="width: 80px; height: 80px; object-fit: cover; margin-right: 10px;">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                                style="width: 80px; height: 80px; margin-right: 10px; font-size:10px;">
                                                {{ $item->product->nama_product }}
                                            </div>
                                        @endif

                                        <div class="flex-grow-1 me-auto">
                                            <div class="fw-semibold text-truncate">{{ $item->product->nama_product }}</div>
                                            <div class="text-muted small">
                                                Harga: Rp {{ number_format($item->product->harga, 0, ',', '.') }} x
                                                {{ $item->quantity }}
                                            </div>
                                            <div class="fw-bold small text-danger">
                                                Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
                                            </div>
                                            <div class="text-dark mt-1 opacity-50">{{ ucfirst($order->dine_option) }}</div>
                                        </div>

                                        <div class="text-end">
                                            <span class="text-dark opacity-50">{{ ucfirst($order->payment) }}</span><br>
                                            <span
                                                class="text-dark mt-1 opacity-50">{{ ucfirst($order->dine_option) }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mt-3 text-dark mt-1 opacity-50">Review:</div>
                                    <div class="text-dark mt-1 opacity-50 ps-3">
                                        {{ $item->review ? $item->review->comment : 'Pembeli Belum Memberikan Ulasan' }} <hr>
                                    </div>
                                @endif

                                @if ($i === $items->count() - 1 && $i > 0)
                        </div> {{-- ========== COLLAPSE END ========== --}}
                @endif
                @endforeach
                

                {{-- ========== ESTIMASI & TOTAL ========== --}}
                <div class="text-start">
                    <p class="alert alert-success text-start fw-bold p-3 w-50 btn-disable w-100 mt-3"
                        style="border: none; color: rgb(5, 151, 127); background-color:rgb(184, 245, 235)">
                        Estimasi Siap 15 menit
                    </p>
                </div>

                <div class="d-flex mt-3">
                    {{-- TOMBOL BATAL --}}
                    <h6 class="fw-bold text-danger mt-1 ms-auto">
                        Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </h6>
                </div>

                 <div class="text-center mt-2">
                    @php
                        $items = $order->orderItems;
                        $reviewCollapseId = 'orderCollapse' . $order->id;
                    @endphp
                    @if ($items->count() > 1)
                        <div class="text-center mt-2">
                            <button class="btn btn-sm text-secondary" type="button"
                                data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                aria-expanded="false" aria-controls="{{ $collapseId }}">
                                Tampilkan menu lainnya ▼
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
            <div class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200" alt="">
                <h2 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Histori Pesanan</h2>
                <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Sepertinya kamu belum menyelesaikan pesanan</small>
            </div>
        </div>
        @endforelse
        {{-- ================== END PESANAN LOOP ================== --}}
    </div>
    </div>
    </div>
    <x-nav-bottom />
@endsection