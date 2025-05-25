@extends('layouts.app')
@php
    use Illuminate\Support\Carbon;
@endphp

@section('content')
    <x-navbarBuyer />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Home" />

                <div class="row g-3">
                    <!-- Kolom 1: Alert -->
                    <div class="col-md-8">
                        <div class="card card-alert animate_animated animate_fadeInUp z-2">
                            <div class="card-body alert-name p-4 d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <p class="text-light text-center text-lg-start text-md-start mb-1">Halo, Selamat Datang
                                    </p>
                                    <h2 class="text-light text-lg-start text-md-start mb-1 mt-0 text-uppercase">
                                        {{ Auth::user()->name }}👋
                                    </h2>

                                    <p style="font-size: 12px !important" class="text-light fw-lighter">
                                        ⏰ Last Login:
                                        {{ Auth::user()->last_logout_at
                                            ? Carbon::parse(Auth::user()->last_logout_at)->translatedFormat('l, d F Y') .
                                                ' · ' .
                                                Carbon::parse(Auth::user()->last_logout_at)->format('H:i')
                                            : '-' }}
                                    </p>
                                </div>
                                <img class="img-fluid" src="{{ asset('img/alert-nama.svg') }}" width="130"
                                    alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom 2: Card tambahan -->
                    <div class="col-md-4">
                        <div class="scroll">
                            <div class="card-body p-0">
                                <div class="d-flex gap-3     align-items-center pt-3 ps-3 pe-3 pb-2">
                                    <h6 class="fw-bold text-primarys m-0">​Pesanan Aktif</h6>
                                    @if ($activeOrders->isNotEmpty())
                                        <span class="badge bg-primary rounded-pill">{{ $totalActiveOrderItems }}</span>
                                    @endif
                                </div>

                                @if ($activeOrders->isNotEmpty())
                                    @foreach ($activeOrders as $order)
                                        @foreach ($order->orderItems as $item)
                                            <a href="{{ route('buyer.pesanan.index') }}"
                                                class="text-decoration-none text-dark">
                                                <div class="body-tugas p-2 ps-3 d-flex justify-content-start align-items-center gap-3 hover-shadow"
                                                    style="cursor: pointer;">
                                                    <div class="tugas-icon fs-5 text-light d-flex justify-content-center align-items-center"
                                                        style="background-color: var(--primary); border-radius: 50%; width: 32px; height: 32px;">
                                                        <i class='bx bxs-notepad'></i>
                                                    </div>
                                                    <div class="tugas-desc">
                                                        <h6 class="m-0 text-secondary"> {{ $item->product->nama_product }}
                                                            <span class="text-muted fw-normal"> ~ (ID:
                                                                {{ $order->id }})</span>
                                                        </h6>
                                                        <p class="m-0 text-muted">Status:
                                                            <span
                                                                class="badge bg-primarys ms-1">{{ ucfirst($order->status) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endforeach
                                @else
                                    <div
                                        class="if-kosong d-flex align-items-center justify-content-center flex-column gap-2">
                                        <lottie-player class="img-fluid"
                                            src="https://assets6.lottiefiles.com/packages/lf20_yuisinzc.json"
                                            background="transparent" speed="1" style="max-width: 100px;" loop
                                            autoplay></lottie-player>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                {{-- PEMBUNGKUS CONTENT --}}
                <div class="card p-3 mb-4 shadow-sm">


                    {{-- FILTER --}}

                    <div class="row g-2 mt-2"> <!-- g-0 = no gutter -->
                        <h6 class="fw-bold text-secondary"><i class='bx bxs-bowl-hot fs-4 me-2 '></i> Menu jempolan saat ini
                            🤩​​</h6>

                        @forelse ($products as $product)
                            <div class="col-6 col-md-3">
                                <div class="card border border-1 border-light rounded-3 shadow-sm">
                                    @if ($product->img)
                                        <img src="{{ asset('images/' . $product->img) }}" class="card-img-top"
                                            alt="{{ $product->nama }}" style="height: 135px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white text-uppercase fw-bold"
                                            style="height: 135px;">
                                            {{ $product->nama_product }}
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <a class="link-primary link-offset-2" style="text-decoration: none;"
                                            href="{{ route('buyer.daftarmenu.show', $product->id) }}">
                                            <p class="mb-2">
                                                <span class="badge bg-secondary rounded-pill px-2 py-1"
                                                    style="font-size: 9px;">
                                                    {{ $product->category?->nama_kategori ?? '-' }}
                                                </span>
                                            </p>

                                            <h6 class="card-title d-flex align-items-center justify-content-start">
                                                <b>{{ $product->nama_product }}</b>

                                                <span style="font-size: 11px; background-color: var(--primary)"
                                                    class="ms-2 badge small">
                                                    {{ $product->order_items_count }}x dibeli
                                                </span>

                                            </h6>

                                        </a>



                                        <p class="text-secondary fw-bold opacity-75" style="font-size: 11px;">Kedai
                                            {{ $product->user?->name ?? '-' }} 🏪</p>

                                        <p class="mb-2">
                                            @php
                                                $averageRating = $product->reviews->avg('rating');
                                                $roundedRating = round($averageRating);
                                            @endphp

                                            @if ($product->reviews->count() > 0)
                                                <div class="text-warning my-1">
                                                    {!! str_repeat('★', $roundedRating) . str_repeat('☆', 5 - $roundedRating) !!}
                                                    <small
                                                        class="text-muted">({{ number_format($averageRating, 1) }}/5)</small>
                                                </div>
                                            @else
                                                <div class="text-muted my-1">
                                                    ~
                                                </div>
                                            @endif
                                        </p>

                                        </p>
                                        <p>{{ Str::limit($product->deskripsi, 36) }}</p>
                                        <h6 class="card-text fw-bold mt-1 mb-2 text-danger mt-2 mb-2">Rp
                                            {{ number_format($product->harga, 0, ',', '.') }}</h6>
                                        <div class="cart-section d-flex align-items-center justify-content-end">
                                            <form action="{{ route('buyer.keranjang.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="addtocart d-flex gap-2 align-items-center justify-content-end">
                                                    <input type="number" name="quantity" value="1" min="1"
                                                        class="form-control" style="width: 65px;"
                                                        {{ $product->user?->is_open ? '' : 'disabled' }}>

                                                    <button type="submit" class="btn btn-warning"
                                                        {{ $product->user?->is_open ? '' : 'disabled' }}
                                                        title="{{ $product->user?->is_open ? 'Tambah ke keranjang' : 'Toko sedang tutup' }}">
                                                        <i class='bx bxs-cart-add fs-5 mt-1 text-white'></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @empty
                            {{-- Tampilkan jika tidak ada item dalam keranjang --}}
                            <div class="card text-center animate_animated animate_fadeInUp" style="border-radius: 50px;">
                                <div
                                    class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                                    <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200"
                                        alt="">
                                    <h2 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Halaman Daftar Menu</h2>
                                    <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Maaf ya, makanan
                                        sedang
                                        tidak tersedia 😭​</small>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                {{-- PEMBUNGKUS CONTENT --}}
            </div>

        </div>
    </div>
    </div>
    <x-nav-bottom />
@endsection
