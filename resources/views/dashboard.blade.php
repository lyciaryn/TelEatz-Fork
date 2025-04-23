@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card card-alert animate__animated animate__fadeInUp z-2">
    <div class="card-body header p-4 d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column">
            <h2 class="fs-4 fw-bold text-secondary">Dashboard</h2>
        </div>
    </div>
</div>

<div class="card text-center animate__animated animate__fadeInUp mt-4" style="border-radius: 50px;">
    <div class="card-body card-nothings bg-light p-5 d-flex justify-content-center align-items-center flex-column">
        <img class="img-fluid" src="{{ asset('img/nothing.svg') }}" width="200" alt="">
        <h2 class="fw-bold fs-4 mt-3 text-dark">Belum transaksi nih!</h2>
        <small class="text-secondary fw-bold" style="font-size: 0.8rem;">Sepertinya kamu belum Belanja apapun</small>
    </div>
</div>
@endsection