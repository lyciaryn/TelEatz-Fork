<div class="nav-bottom fixed-bottom d-flex justify-content-evenly align-items-center fs-3">
    @foreach(['Home' => 'bxs-dashboard', 'Pesanan' => 'bx-buildings', 'Keranjang' => 'bx-food-menu', 'Profil' => 'bx-table'] as $name => $icon)
    <div class="d-flex align-items-center">
        <a href="#">
            <div class="btn-bottom d-flex flex-column align-items-center">
                <i class='bx {{ $icon }} text-light mb-1'></i>
                <p class="fs-6 fw-bold text-light m-0" style="font-size: 0.65rem !important;">{{ $name }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>