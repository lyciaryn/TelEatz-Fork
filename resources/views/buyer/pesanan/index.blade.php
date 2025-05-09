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

                <div class="nav nav-pills mb-3" role="tablist">
                    <a class="nav-link {{ request('status') === null ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index') }}">Semua</a>
                    <a class="nav-link {{ request('status') === 'pending' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'pending']) }}">Pending</a>
                    <a class="nav-link {{ request('status') === 'diproses' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'diproses']) }}">Diproses</a>
                    <a class="nav-link {{ request('status') === 'selesai' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'selesai']) }}">Selesai</a>
                    <a class="nav-link {{ request('status') === 'dibatalkan' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'dibatalkan']) }}">Dibatalkan</a>
                </div>


                {{-- ================== PESANAN LOOP ================== --}}
                @forelse($orders as $order)
                    <div class="card mb-3 p-3">
                        {{-- ========== HEADER PESANAN ========== --}}
                        <div class="card-header bg-white d-flex align-items-center justify-content-between">
                            <div>
                                <strong>🏪 Kedai
                                    {{ $order->order_items->first()?->product->user->name ?? 'Tidak Diketahui' }}</strong><br>
                                <small class="text-muted"><b>No. Antrian: {{ $order->id }}</b></small><br>
                                <small class="text-muted">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            <span class="fw-bold text-{{ $order->status === 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        {{-- ========== BODY PESANAN ========== --}}
                        <div class="card-body p-2">
                            @php
                                $items = $order->order_items;
                                $collapseId = 'orderCollapse' . $order->id;
                            @endphp

                            {{-- ========== ITEM PERTAMA ========== --}}
                            @foreach ($items as $i => $item)
                                @php $subtotal = $item->price * $item->quantity; @endphp

                                @if ($i === 0)
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center border-bottom py-2 ps-3 gap-2">
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
                                                Harga: Rp {{ number_format($item->price, 0, ',', '.') }} x
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

                                    @if ($items->count() > 1)
                                        <div class="text-center mt-2">
                                            <button class="btn btn-sm text-secondary" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                                aria-expanded="false" aria-controls="{{ $collapseId }}">
                                                Tampilkan menu lainnya ▼
                                            </button>
                                        </div>
                                    @endif
                                @elseif ($i === 1)
                                    {{-- ========== COLLAPSE START ========== --}}
                                    <div class="collapse mt-2" id="{{ $collapseId }}">
                                @endif

                                {{-- ========== ITEM SELAIN PERTAMA ========== --}}
                                @if ($i > 0)
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center border-bottom py-2 ps-3 gap-2">
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
                                                Harga: Rp {{ number_format($item->price, 0, ',', '.') }} x
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
                                @endif

                                @if ($i === $items->count() - 1 && $i > 0)
                        </div> {{-- ========== COLLAPSE END ========== --}}
                @endif
                @endforeach

                {{-- ========== ESTIMASI & TOTAL ========== --}}
                <div class="text-start mt-3">
                    @if ($order->estimated_ready_at)
                        <p class="alert alert-success fw-bold p-3 w-100"
                            style="border: none; color: rgb(5, 151, 127); background-color:rgb(184, 245, 235)">
                            Estimasi Siap pada {{ $order->estimated_ready_at->format('H:i') }}
                        </p>
                    @endif

                </div>

                <div class="text-end mt-3 fw-bold d-flex justify-content-between">
                    {{-- TOMBOL BATAL --}}
                    @if ($order->status === 'pending')
                        <a href="#" class="btn btn-outline-danger btn-sm"
                            onclick="event.preventDefault(); confirmCancel({{ $order->id }})">
                            Batalkan Pesanan
                        </a>

                        <form id="cancel-form-{{ $order->id }}"
                            action="{{ route('buyer.pesanan.destroy', $order->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @else
                        <button class="btn btn-outline-secondary btn-sm rounded" disabled>
                            Batalkan Pesanan
                        </button>
                    @endif

                    <h6 class="text-center fw-bold text-danger mt-1">
                        Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </h6>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Tidak ada pesanan ditemukan.</p>
        @endforelse
        {{-- ================== END PESANAN LOOP ================== --}}
    </div>
    </div>
    </div>
    <x-nav-bottom />
@endsection
