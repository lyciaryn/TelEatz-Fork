// resources/views/partials/navbar.blade.php
<nav class="navbar navbar-expand-lg shadow-sm bg-body fixed-top">
    <div class="container">
        <!-- Brand Title -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold me-2" style="font-size: 1.8rem; color: var(--darkt);" href="#">TelEatz</a>
            <span class="text-secondary fw-semibold" style="font-size: 1.35rem;">Telkom University</span>
        </div>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse mt-sm-4 mt-lg-0" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <!-- Mobile Menu (optional) -->
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-dark" href="#">Home</a>
                    <a class="nav-link text-dark" href="#">Daftar Menu</a>
                    <a class="nav-link text-dark" href="#">Pesanan</a>
                    <a class="nav-link text-dark" href="#">Keranjang</a>
                    <a class="nav-link text-dark" href="#">Histori Pesanan</a>
                    <a class="nav-link text-dark" href="#">Profil Saya</a>
                    <a class="nav-link text-danger fw-bold" href="login-no.html">
                        <i class='bx bx-log-out-circle'></i> Keluar
                    </a>
                </li>

                <!-- Profile dropdown (desktop) -->
                <li class="nav-item dropdown d-none d-lg-flex align-items-center">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle img-thumbnail shadow-lg me-2" src="{{ asset('img/sekolah.jpg') }}" width="50">
                        @yanvios
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item text-danger fw-bold" href="login-no.html">
                                <i class="bi bi-box-arrow-left"></i> Keluar
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>