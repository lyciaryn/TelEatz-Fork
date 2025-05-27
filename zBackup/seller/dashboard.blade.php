@extends('layouts.app')

@section('content')
    <x-navbar_seller/>
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_seller />
            </div>
            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Dashboard" />
                <div class="row g-3">
                    <!-- Kolom 1: Alert -->
                    <div class="col-md-8">
                        <div class="card card-alert animate_animated animate_fadeInUp z-2">
                            <div class="card-body alert-name p-4 d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <p class="text-light text-center text-lg-start text-md-start mb-1">Halo, Selamat Datang
                                    </p>
                                    <h2 class="text-light text-lg-start text-md-start mb-1 mt-0 text-uppercase">
                                        {{ Auth::user()->name }}👋
                                    </h2>
                                    <p style="font-size: 12px !important" class="text-light fw-lighter ">⏰ Terakhir Login:
                                        20:202:20s</p>
                                </div>
                                <img class="img-fluid" src="{{ asset('img/alert-nama.svg') }}" width="130"
                                    alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom 2: Card tambahan -->
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Buka Toko</h5>
                                <p class="card-text text-center">{{$status}}</p>
                            </div>
                            <div class="text-center pb-3">
                                <form action="{{ route('seller.dashboard.status') }}" method="POST">
                                    @csrf
                                    @if ($status == 'Sedang Tutup')
                                    <input type="hidden" name="action" value="buka">
                                    <button type="submit" class="btn btn-primary w-75">Buka Toko</button>

                                    @else
                                    <input type="hidden" name="action" value="tutup">
                                    <button type="submit" class="btn btn-danger w-75">Tutup Toko</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Total Produk</h5>
                                <p class="text-center pb-3">{{$makanan}} Produk</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Total Penjualan</h5>
                                <p class="text-center pb-3">{{ $order }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Total Review</h5>
                                <p class="text-center pb-3">{{ $totalReviews }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Rata - Rata Review</h5>
                                <p class="text-center pb-3">{{ number_format($avgReviews, 2, ',') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Grafik Harian -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Grafik Pemasukan Per Bulan</h5>
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Grafik Mingguan -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Grafik Pemasukan Per Minggu</h5>
                                <canvas id="weeklyChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Grafik Harian -->
                    <div class="col-md-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Grafik Pemasukan Per Hari</h5>
                                <canvas id="dailyChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Total Pemasukan -->
                    <div class="col-md-12 mb-5">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center pb-3">Total Pemasukan Selama Berdagang</h5>
                                    <h5 class="text-center">Rp. {{ number_format(150000, 0, ',', '.') }}</h5>
                        </div>
                    </div>

                    
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
                        new Chart(weeklyCtx, {
                            type: 'bar',
                            data: {
                                labels: [@foreach($weeklyLabels as $label)'{{ $label }}', @endforeach],
                                datasets: [{
                                    label: 'Pemasukan Mingguan',
                                    data: [@foreach($weeklyData as $data){{ $data }}, @endforeach],
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });

                        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
                        new Chart(monthlyCtx, {
                            type: 'bar',
                            data: {
                                labels: [@foreach($monthlyLabels as $label)'{{ $label }}', @endforeach],
                                datasets: [{
                                    label: 'Pemasukan Bulanan',
                                    data: [@foreach($monthlyData as $data){{ $data }}, @endforeach],
                                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });

                        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
                        new Chart(dailyCtx, {
                            type: 'bar',
                            data: {
                                labels: [
                                    @foreach($dailyLabels as $label)'{{ $label }}',@endforeach],
                                datasets: [{
                                    label: 'Pemasukan Harian',
                                    data: [
                                        @foreach($dailyData as $data)
                                            {{ $data }},
                                        @endforeach
                                    ],
                                    backgroundColor: 'rgba(75, 192, 192, 0.5)',  // kamu bisa ganti warna sesuai selera
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });

                    </script>

                </div>
            </div>
        </div>
    </div>
    <x-nav-bottom_seller />
@endsection
