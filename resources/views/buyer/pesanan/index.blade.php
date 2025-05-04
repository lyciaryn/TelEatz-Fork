@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container">
    <div class="row dash" style="margin-top: 100px;">
        <div class="col-lg-3 pos">
            <x-sidebar />
        </div>
        <div class="col-lg-9 d-flex flex-column gap-3">
            <x-header title="Keranjang Saya" />
            <x-breadcrumbs :links="[
                ['label' => 'Dashboard', 'url' => route('buyer.dashboard')],
                ['label' => 'Pesanan Saya'],
            ]" />
            <p>Halaman Pesanan</p>


        </div>
    </div>
</div>
<x-nav-bottom />
@endsection
