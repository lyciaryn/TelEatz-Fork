<div class="col-lg-3">
    <div class="card-nav card mb-3 animate__animated animate__fadeInUp">
        <div class="card-body nav-dash d-flex flex-column gap-3">
            <div class="nav-2 sidebar-profile d-flex align-items-center py-3 px-3">
                <img class="rounded-circle img-thumbnail shadow-lg" src="{{ asset('img/sekolah.jpg') }}" alt="" width="50">
                <div class="ms-3">
                    <p class="fw-bold text-light mb-0">Vio Salman</p>
                    <p class="text-light" style="font-size: 13px;">Pembeli</p>
                </div>
            </div>
            @foreach(['Home', 'Daftar Menu', 'Pesanan', 'Keranjang', 'Histori Pesanan', 'Profil Saya', 'Logout'] as $item)
            <a class="nav-link d-flex align-items-center gap-2" href="#">
                <i class='bx bx-home-alt me-2'></i>
                <p style="font-size: 14px;">{{ $item }}</p>
            </a>
            @endforeach
        </div>
    </div>
</div>
