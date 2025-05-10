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

                <div class="nav nav-pills fw-bold mb-3 d-flex gap-3" role="tablist">
                    <a class="nav-link {{ request('status') === null ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index') }}">
                        Semua ({{ $statusCounts['all'] }})
                    </a>
                    <a class="nav-link {{ request('status') === 'pending' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'pending']) }}">
                        Pending ({{ $statusCounts['pending'] }})
                    </a>
                    <a class="nav-link {{ request('status') === 'diproses' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'diproses']) }}">
                        Diproses ({{ $statusCounts['diproses'] }})
                    </a>
                    <a class="nav-link {{ request('status') === 'selesai' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'selesai']) }}">
                        Selesai ({{ $statusCounts['selesai'] }})
                    </a>
                    <a class="nav-link nav-danger {{ request('status') === 'dibatalkan' ? 'active' : '' }}"
                        href="{{ route('buyer.pesanan.index', ['status' => 'dibatalkan']) }}">
                        Dibatalkan ({{ $statusCounts['dibatalkan'] }})
                    </a>
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
                            <span
                                class="fw-bold text-{{ $order->status === 'dibatalkan' ? 'danger' : ($order->status === 'selesai' ? 'success' : 'warning') }}">
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
                    @if ($order->estimated_ready_at || $order->status === 'selesai' || $order->status === 'dibatalkan')
                        <h6 class="alert fw-bold p-3 w-100"
                            style=" border: none;  background-color: {{ $order->status === 'selesai'
                                ? 'rgb(184, 245, 235)'
                                : ($order->status === 'dibatalkan'
                                    ? '#ffe5e5'
                                    : 'rgb(184, 245, 235)') }}; color: {{ $order->status === 'dibatalkan' ? '#d8000c' : 'rgb(5, 151, 127)' }};">

                            @if ($order->status === 'selesai')
                                Pesanan siap diambil
                            @elseif ($order->status === 'dibatalkan')
                                Pesanan dibatalkan
                            @else
                                Estimasi Siap pada {{ $order->estimated_ready_at->format('H:i') }}
                            @endif
                        </h6>
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
                            action="{{ route('buyer.pesanan.cancelOrder', $order->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    @elseif ($order->status === 'selesai')
                        <div class="buttons d-flex gap-3">

                            <a href="{{ route('buyer.pesanan.downloadFaktur', $order->id) }}"
                                class="btn btn-outline-success btn-sm d-flex gap-2 justify-content-center align-items-center"
                                style="border-radius: 5px !important">
                                <i class='bx bxs-file-pdf fs-5 mt-1'></i>
                                <p class="mt-1 fw-bold">Download Faktur</p>
                            </a>

                            @php
                                $productId = $order->order_items->first()->product_id;
                                $hasReviewed = \App\Models\Review::where('buyer_id', auth()->id())
                                    ->where('product_id', $productId)
                                    ->where('order_id', $order->id)
                                    ->exists();
                            @endphp

                            <a href="{{ $hasReviewed
                                ? route('buyer.daftarmenu.show', $productId) // hanya productId saja
                                : route('buyer.review.create', ['order' => $order->id, 'product' => $productId]) }}"
                                class="btn btn-warning btn-sm d-flex gap-2 justify-content-center align-items-center">
                                <i class='bx bxs-star'></i>
                                <p class="mt-1 fw-bold">
                                    {{ $hasReviewed ? 'Lihat Penilaian' : 'Berikan Ulasan' }}
                                </p>
                            </a>




                        </div>
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
