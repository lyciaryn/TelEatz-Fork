@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_admin />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Kelola Kategori" />
                <div class="row g-3">
                    <!-- Kolom 1: Alert -->
                    <h1>Kelola Kategori</h1>
                </div>
            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
