@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_seller />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Dashboard" />
                <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
                    <form action="{{ route('kelolamakanan.showdetail', $makanan->id) }}" method="GET"
                        enctype="multipart/form-data">
                        @csrf
                        <div
                            class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                            <div class="d-flex align-items-center">
                                @if ($makanan->img)
                                <img src="{{ asset('storage/' . $makanan->img) }}" alt="{{ $makanan->nama_product }}"
                                    class="img-fluid me-4" style="max-width: 300px; height: auto; border-radius: 20px;">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-success text-white text-uppercase fw-bold px-3" style="height: 135px; border-radius: 16px;">
                                        {{ $makanan->nama_product }}
                                    </div>
                                @endif

                                <div class="px-3">
                                    <div>
                                        <label style="text-align: left;">Nama Makanan</label>
                                        <input type="text" class="form-control" size="1000" name="nama_product"
                                            value="{{ $makanan->nama_product }}" required disabled>
                                    </div>
                                    <div>
                                        <label class="mt-4" style="text-align: left;">Harga</label>
                                        <input type="text" class="form-control" size="1000" name="harga"
                                            value="{{ $makanan->harga }}" required disabled>
                                    </div>
                                    <div>
                                        <label class="mt-4" style="text-align: left;">Deskripsi</label>
                                        <textarea type="text" class="form-control" size="1000" name="deskripsi" required disabled>{{ $makanan->deskripsi }}</textarea>
                                    </div>
                                    <div>
                                        <label class="mt-4" for="is_avaialable">Tersedia?</label>
                                        <select name="is_available" class="form-select" aria-label="Pilih kategori" required
                                            disabled>
                                            <option selected disabled>Pilih Ketersediaan</option>
                                            <option value="1" {{ $makanan->is_available == 1 ? 'selected' : '' }}>
                                                Tersedia</option>
                                            <option value="0" {{ $makanan->is_available == 0 ? 'selected' : '' }}>Tidak
                                                Tersedia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    <x-nav-bottom />
@endsection
