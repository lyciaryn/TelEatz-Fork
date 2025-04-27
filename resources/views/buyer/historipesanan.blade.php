@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar />
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Pesanan" />
            <div class="card text-center animate_animated animate_fadeInUp mt-4" style="border-radius: 50px;">
                <div class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
                    <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200" alt="">
                    <h2 class="fw-bold fs-4 mt-3" style="color:var(--darkt);">Halaman Histori Pesanan</h2>
                    <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Sepertinya kamu belum Belanja apapun</small>
                </div>
            </div>
        </div>
    </div>
</div>
<x-nav-bottom />
@endsection
