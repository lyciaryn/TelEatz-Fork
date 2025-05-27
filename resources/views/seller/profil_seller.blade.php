@extends('layouts.app')

@section('content')
<x-navbar_seller />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
           <x-sidebar_seller />
        {{-- Kolom Kiri: Formulir Profile --}}
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white fw-bold rounded-top-4">
                    Profile Detail
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">NIS</label>
                                <input type="text" class="form-control" value="129840" readonly>
                            </div>
                            <div class="col">
                                <label class="form-label">NISN/NIP</label>
                                <input type="text" class="form-control" value="08858009" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="Vio Salman Kafiyan" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control" rows="2" readonly>and I'm jawa sumatra who's called padang HITAM</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tempat, tanggal lahir</label>
                            <textarea class="form-control" rows="2" readonly>8 Januari, 1998</textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-50 rounded-pill">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Profile Picture --}}
        <div class="col-md-4 mt-4 mt-md-0">
            <div class="card shadow rounded-4 text-center">
                <div class="card-header bg-primary text-white fw-bold rounded-top-4">
                    Profile Picture
                </div>
                <div class="card-body">
                    <img src="https://via.placeholder.com/100" class="rounded-circle border border-white shadow mb-3" width="100" height="100" alt="Foto Profil">
                    <h5 class="fw-bold">Yanvios</h5>
                    <div class="text-muted">User</div>
                    <p class="small mt-2">and I'm jawa sumatra who's called <br> padang HITAM</p>
                    <button class="btn btn-dark w-75 rounded-pill mt-2">
                        <i class="bi bi-cloud-upload"></i> Upload Foto
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<x-nav-bottom />
@endsection