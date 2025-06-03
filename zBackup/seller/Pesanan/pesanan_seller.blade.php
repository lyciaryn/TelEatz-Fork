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
                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('seller.dashboard')], ['label' => 'Pesanan Saya']]" />

                <div class="card p-3 mb-4 shadow-sm">
                    <form method="GET" action="{{ route('seller.pesanan') }}">
                        <div class="row align-items-end mb-4 g-2">
                            {{-- Select Filter --}}
                            <div class="col-12 col-md-3">
                                <label for="status" class="form-label" style="font-size: 14px;">Status</label>
                                <select name="status" id="status" class="form-select"
                                    style="font-size: 14px; background-color: #fcfeff;">
                                    <option value="">Semua Status</option>
                                    @foreach ($allStatus as $status)
                                        <option value="{{ $status }}"
                                            {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="dine_option" class="form-label" style="font-size: 14px;">Dine Options</label>
                                <select name="dine_option" id="dine_option" class="form-select"
                                    style="font-size: 14px; background-color: #fcfeff;">
                                    <option value="">Dine Options</option>
                                    @foreach ($allDineOptions as $dine_option)
                                        <option value="{{ $dine_option }}"
                                            {{ request('dine_option') == $dine_option ? 'selected' : '' }}>
                                            {{ ucfirst($dine_option) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="status" class="form-label" style="font-size: 14px;">Pembayaran</label>
                                <select name="payment" id="payment" class="form-select"
                                    style="font-size: 14px; background-color: #fcfeff;">
                                    <option value="">Pembayaran</option>
                                    @foreach ($allPayment as $payment)
                                        <option value="{{ $payment }}"
                                            {{ request('payment') == $payment ? 'selected' : '' }}>
                                            {{ ucfirst($payment) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="ordering" class="form-label" style="font-size: 14px;">Urutan</label>
                                <select name="ordering" id="ordering" class="form-select" style="font-size: 14px; background-color: #fcfeff;">
                                    <option value="desc" {{ request('ordering') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="asc" {{ request('ordering') == 'asc' ? 'selected' : '' }}>Terlama</option>
                                </select>
                            </div>
                            {{-- Input Search --}}
                            <div class="col-12 col-md-4">
                                <label for="search" class="form-label" style="font-size: 14px; background-color: #fcfeff;">Cari Menu</label>
                                <div class="d-flex justify-content-end">

                                    <input type="text" name="search" id="search" class="form-control"
                                    placeholder="🔍   Cari nama menu"
                                    value="{{ request('search') }}">
                                </div>
                            </div>
                            
                            {{-- Tombol Search --}}
                            <div class="col-12 col-md-2 d-grid">
                                <button type="submit" name="search_button" value="1"
                                class="btn btn-primary d-flex justify-content-center align-items-center"
                                style="border-radius: 8px !important; box-shadow:none !important">
                                <i class='bx bx-search me-1'></i>
                                <span style="font-size: 14px;">Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                
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
                                $items = $order->order_items;
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
                                            <img src="{{ asset('storage/' . $item->product->img) }}" class="rounded"
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
                                                asd
                                            </div>
                                            <div class="text-muted small">qwe</div>
                                        </div>

                                        <div class="text-end">
                                            <span class="text-dark opacity-50">{{ ucfirst($order->payment) }}</span><br>
                                            <span
                                                class="text-dark mt-1 opacity-50">{{ ucfirst($order->dine_option) }}</span>
                                        </div>
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
                                            <img src="{{ asset('storage/' . $item->product->img) }}" class="rounded"
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

                <div class="text-end mt-3 fw-bold d-flex justify-content-between align-items-center">
                    {{-- TOMBOL LANJUT --}}
                    <form action="{{ route('seller.pesanan.status', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-lg px-4 py-2 small" style="font-size: 0.9rem;">
                            @if ($order->status == 'pending')
                                Lanjut Ke Diproses
                            @elseif ($order->status == 'diproses')
                                Lanjut Ke Selesai
                            @else
                                Update Status
                            @endif
                        </button>
                    </form>

                    {{-- TOTAL HARGA --}}
                    <h6 class="fw-bold text-danger mt-1 mb-0">
                        Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </h6>
                </div>

            </div>
        </div>
    @empty
        <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
            <div class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200" alt="">
                <h2 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Halaman Pesanan</h2>
                <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Sepertinya toko kamu belum ada yang pesan</small>
            </div>
        </div>
        @endforelse
        {{-- ================== END PESANAN LOOP ================== --}}
    </div>
    </div>
    </div>
    <x-nav-bottom />
@endsection