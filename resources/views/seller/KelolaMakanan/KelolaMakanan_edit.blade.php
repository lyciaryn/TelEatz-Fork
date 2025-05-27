
@extends('layouts.app')

@section('content')
@php
$title = 'Edit Produk Saya';
@endphp
<x-navbar_seller />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar_seller/>
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Dashboard" />
            <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
            <form action="{{ route('kelolamakanan.update', $makanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                    <div class="d-flex align-items-center">
                        @if ($makanan->img)
                            <img src="{{ asset('images/' . $makanan->img) }}" alt="{{ $makanan->nama_product }}"
                                class="img-fluid me-4" style="max-width: 300px; height: auto; border-radius: 20px;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-success text-white text-uppercase fw-bold px-3" style="height: 135px; border-radius: 16px;">
                                    {{ $makanan->nama_product }}
                                </div>
                        @endif
                        <div class="px-3">
                            <h1 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Edit Menu Makanan</h1>
                            <div>
                                <label class="mt-3" style="text-align: left;">Nama Makanan</label>
                                <input type="text" class="form-control" size="1000" name="nama_product" value="{{ $makanan->nama_product }}" required>
                            </div>
                            <div>
                                <label class="mt-3" style="text-align: left;">Harga</label>
                                <input type="text" class="form-control" size="1000" name="harga" value="{{ $makanan->harga }}" required>
                            </div>
                            <div>
                                <label class="mt-3" style="text-align: left;">Deskripsi</label>
                                <textarea type="text" class="form-control" size="1000" name="deskripsi" required>{{ $makanan->deskripsi }}</textarea>
                            </div>
                            <div>
                                <label class="mt-3" for="is_avaialable">Tersedia?</label>
                                <select name="is_available" class="form-select mt-3" aria-label="Pilih kategori" required>
                                    <option selected disabled>Pilih Ketersediaan</option>
                                    <option value="1" {{ $makanan->is_available == 1 ? 'selected' : '' }}>Tersedia</option>
                                    <option value="0" {{ $makanan->is_available == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                                </select>
                            <div class="mt-3" style="margin-bottom: 20px; display: flex; flex-direction: column; align-items: center;">
                                <label for="img">Gambar</label>
                                <input type="file" name="img" id="img" class="form-control" onchange="previewImage()" style="max-width: 300px;">
                                <br>
                                <label for="preview-img">Preview Gambar</label>
                                <!-- Preview Gambar -->
                                <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-danger">Batal</button>
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