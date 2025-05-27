@extends('layouts.app')

@section('content')
<x-navbar_seller />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar_seller/>
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Kelola Makanan" />
            <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
                <div class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-left flex-column">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('kelolamakanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label style="mt-4 text-align: left;">Nama Makanan</label>
                        <input type="text" class="form-control" size="1000" name="nama_product" required>
                    </div>
                    <div>
                        <label class="mt-4 text-start">Harga</label>
                        <input type="text" class="form-control" name="harga" required>
                    </div>
                    <div>
                        <label class="mt-4 text-start">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div>
                        <label class="mt-4 text-start" for="is_avaialable">Tersedia?</label>
                        <select name="is_available" class="form-select" aria-label="Pilih kategori" required>
                            <option selected disabled>Pilih Ketersediaan</option>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div>
                        <label class="mt-4 text-start">Kategori</label>
                        <select name="category_id" class="form-select" aria-label="Pilih kategori" required>
                            <option selected disabled>Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4 text-start" style="margin-bottom: 20px; display: flex; flex-direction: column; align-items: center;">
                                <label for="img">Gambar</label>
                                <input type="file" name="img" id="img" class="form-control" onchange="previewImage()" style="max-width: 300px;">
                                <br>
                                <label for="preview-img">Preview Gambar</label>
                                <!-- Preview Gambar -->
                                <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;">
                            </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
<x-nav-bottom />
@endsection
