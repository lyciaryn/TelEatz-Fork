<div class="nav-bottom fixed-bottom d-flex justify-content-evenly align-items-center fs-3">
    @foreach ([
    ['icon' => 'bxs-dashboard', 'label' => 'Home'],
    ['icon' => 'bx-buildings', 'label' => 'Pesanan'],
    ['icon' => 'bx-food-menu', 'label' => 'Keranjang'],
    ['icon' => 'bx-table', 'label' => 'Profil'],
    ] as $item)
    <div class="d-flex align-items-center">
        <a href="#">
            <div class="btn-bottom d-flex justify-content-center flex-column align-items-center">
                <i class='bx {{ $item['icon'] }} text-light mb-1'></i>
                <p class="fs-6 fw-bold text-light m-0" style="font-size: 0.65rem !important;">{{ $item['label'] }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>