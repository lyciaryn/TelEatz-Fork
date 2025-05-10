@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar_admin/>
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Dashboard" />
    <div class="row g-3">
        <!-- Kolom 1: Alert -->
        <div class="col-md-8">
            <div class="card card-alert animate_animated animate_fadeInUp z-2">
                <div class="card-body alert-name p-4 d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column">
                        <p class="text-light text-center text-lg-start text-md-start mb-1">Halo, Selamat Datang</p>
                        <h2 class="fs-2 text-light text-uppercase">Juragan, {{ Auth::user()->name }}👋</h2>
                        <p style="font-size: 12px !important" class="text-light fw-lighter ">⏰ Terakhir Login: 20:202:20</p>
                    </div>
                    <img class="img-fluid" src="{{ asset('img/alert-nama.svg') }}" width="130" alt="">
                </div>
            </div>
        </div>

        <!-- Kolom 2: Card tambahan -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Info Tambahan</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, maiores!.</p>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
<x-nav-bottom />
@endsection
