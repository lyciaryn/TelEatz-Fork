<div class="nav-bottom fixed-bottom d-flex justify-content-evenly align-items-center fs-3">


    <div class="beranda d-flex align-items-center">
        <a href="{{ route('admin.dashboard') }}">
            <div class="btn-bottom d-flex justify-content-center flex-column align-items-center">
                <i class='bx bxs-home text-light mb-1 fw'></i>
                <p style="font-size: 0.65rem !important;" class="fs-6 fw-bold text-light m-0 ">Home</p>
            </div>
        </a>
    </div>
    <div class="kelas d-flex align-items-center">
        <a href="{{ route('admin.kelola_akun.index') }}">
            <div class="btn-bottom d-flex justify-content-center flex-column align-items-center">
                <i class='bx bxs-user-detail text-light me-2'></i>
                <p style="font-size: 0.65rem !important;" class="fs-6 fw-bold text-light m-0">Kelola User</p>
            </div>
        </a>
    </div>
    <div class="materi d-flex align-items-center">
        <a href="{{ route('admin.kategori.index') }}">
            <div class="btn-bottom d-flex justify-content-center flex-column align-items-center">
                <i class='bx bxs-cart-alt text-light mb-1'></i>
                <p style="font-size: 0.65rem !important;" class="fs-6 fw-bold text-light m-0">Kelola Kategori</p>
            </div>
        </a>
    </div>
    <div class="ujian d-flex align-items-center">
        <a href="{{ route('admin.transaction') }}">
            <div class="btn-bottom d-flex justify-content-center flex-column align-items-center">
                <i class='bx bxs-notepad text-light mb-1'></i>
                <p style="font-size: 0.65rem !important;" class="fs-6 fw-bold text-light m-0">Histori Transaksi</p>
            </div>
        </a>
    </div>
</div>



<!--

<div class="nav-bottom fixed-bottom d-flex justify-content-evenly align-items-center fs-3">
    @foreach ([['icon' => 'bxs-dashboard', 'label' => 'Home'], ['icon' => 'bx-buildings', 'label' => 'Pesanan'], ['icon' => 'bx-food-menu', 'label' => 'Keranjang'], ['icon' => 'bx-table', 'label' => 'Profil']] as $item)
<div class="d-flex align-items-center">
        <a href="#">
            <div class="btn-bottom d-flex justify-content-center flex-column align-items-center">
                <i class='bx {{ $item['icon'] }} text-light mb-1'></i>
                <p class="fs-6 fw-bold text-light m-0" style="font-size: 0.65rem !important;">{{ $item['label'] }}</p>
            </div>
        </a>
    </div>
@endforeach
</div> -->
