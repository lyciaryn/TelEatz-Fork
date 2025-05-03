<div class="card-nav card mb-3 animate_animated animate_fadeInUp">
    <div class="card-body nav-dash d-flex flex-column text-decoration-none gap-3 ">
        <div class=" nav-2 sidebar-profile d-flex justify-content-start align-items-center py-3  px-3">
            <img class="rounded-circle img-thumbnail shadow-lg"
                src="{{ asset('img/sekolah.jpg') }}"
                alt="Profil" width="50">
            <div class="nav-link ms-3" href="">
                <p id="username-sidebar" style="font-size: 17px;" class="fw-bold text-light">Vio Salman</p>
                <p style="font-size: 13px;" class="text-light">Pembeli <i class='bx bxs-check-shield p-0 m-0'></i></p>
            </div>

        </div>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('buyer.dashboard') }}"><i class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Home</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('buyer.daftarmenu.index') }}"><i class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Daftar Menu</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="/pesanan"><i class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Pesanan</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('buyer.keranjang.index') }}"><i class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Keranjang</p>
        </a>
        <div class="border-top"></div>



        <a class="nav-link d-flex align-items-center gap-2" href="/historipesanan"><i class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Histori Pesanan</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="/profil"><i class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Profil Saya</p>
        </a>
        <div class="border-top"></div>
        <a class="nav-link d-flex align-items-center gap-2 mt-1" href=""><i
                class='bx bx-home-alt me-2'></i>
            <!-- Form logout tersembunyi -->
            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!-- Tombol logout -->
            <button type="button" onclick="event.preventDefault(); confirmLogout()">Logout</button>
        </a>
    </div>

</div>
