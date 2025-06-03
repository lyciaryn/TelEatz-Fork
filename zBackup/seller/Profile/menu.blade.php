@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar_seller/>
        </div>

        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Profil Saya"/>
            <div class="card shadow rounded-4 text-center">
                <form action="{{ route('seller.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mx-2 mt-4">
                        {{-- Kolom kanan: Profile Picture --}}
                        <div class="row flex-row-reverse">
                            
                            <div class="col mx-2">
                                <div class="Profile Picture">
                                    <label class="form-label">Profile Picture</label>
                                    
                                </div>
                                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                    @if ($profile->img)
                                    <img src="{{ asset('storage/' . $profile->img) }}" class="rounded-circle border border-white shadow mb-3" width="100" height="100">
                                    @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-muted" style="width: 100px; height: 100px;">{{ $profile->name }}</div>
                                    @endif
                                    <h5 class="fw-bold">{{$profile->name}}</h5>
                                    <div class="text-muted">Upload Gambar</div>
                                    <input type="file" name="img" id="img" class="form-control" onchange="previewImage()" style="max-width: 300px;">
                                    <label class="form-label">Preview</label>
                                    <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;">
                                </div>
                            </div>
                            {{-- Kolom kiri: Profile detail --}}
                            <div class="col-md-8">
                                <div class="card text-center animate_animated animate_fadeInUp" style="border-radius: 50px;">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" value="{{$profile->name}}">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Open Time</label>
                                            <input type="time" name="open_time" class="form-control" value="{{old('open_time', $profile->open_time)}}" placeholder="Format Ketik = 08:00">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Close Time</label>
                                            <input type="time" name="close_time" class="form-control" value="{{old('close_time', $profile->close_time)}}"placeholder="Format Ketik = 23:59">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{$profile->email}}" placeholder=":00">
                                    </div>
                                    <div class="text-center d-flex justify-content-between mx-5">
                                        <button type="submit" class="btn btn-primary w-50 mx-2 rounded-pill">Simpan</button>
                                        <button type="reset" class="btn btn-danger w-50 mx-2 rounded-pill">Reset</button>
                                    </div>
                                    <div class="text-center d-flex justify-content-between my-2 mx-5">
                                        <a href="{{ route('seller.profile.changePassword') }}" class="btn btn-secondary w-50 mx-2 rounded-pill">Ganti Password</a>
                                        <a href="{{ route('seller.profile.changeEmail') }}" class="btn btn-secondary w-50 mx-2 rounded-pill">Ganti Email</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    </form>
                </div>
    </div>    
</div>
<x-nav-bottom />
@endsection
