<nav class="navbar navbar-expand-lg d-flex p-lg-0 p-sm-3 shadow-sm bg-body fixed-top mb-6">
    <div class="container d-flex">
        <!-- ======================= NAVBAR TITLE ======================= -->
        <div class="d-flex justify-content-center
            align-items-center">
            <a class="navbar-brand" href="#">
                <a class="nav-link fw-bold me-2" href=""
                    style="color: var(--darkt);  font-size: 1.8rem;">TelEatz</a>
                <a class="nav-link text-secondary fw-semibold pt-1" href=""
                    style="display: block; font-size: 1.35rem;">
                    Telkom University</a>
            </a>
        </div>

        <div class="togglers d-flex justify-content-center align-items-center gap-2">
            <a class="nav-link px-0 d-lg-none" href="#"><img class="rounded-circle img-thumbnail shadow-lg"
                    src="img/sekolah.jpg" alt="" width="50" srcset=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <!-- ======================= NAVBAR TITLE ======================= -->

        <!-- ======================= NAVBAR DROPDOWN ======================= -->
        <div class="collapse navbar-collapse mt-sm-4 mt-lg-0" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto d-flex justify-content-centera align-items-center">
                <li class="nav-item">
                </li>
                <div class="responsive-nav-drop d-lg-none mb-3 " style="border-radius: 25px; width: 80%;">
                    <li class="nav-item text-center border-2 text-light "
                        style=" padding: 1rem; border: 1px solid rgba(0, 0, 0, 0.09); background-color: var(--primary); border-radius: 25px; margin-top: 1rem;">
                        <a class="nav-link px-0 text-light " href="/dashboard">Home</a>
                        <a class="nav-link px-0 text-light " href="/daftarmenu">Daftar Menu</a>
                        <a class="nav-link px-0 text-light " href="/pesanan">Pesanan</a>
                        <a class="nav-link px-0 text-light " href="/keranjang">Keranjang</a>
                        <a class="nav-link px-0 text-light " href="/historipesanan">Histori Pesanan</a>
                        <a class="nav-link px-0 text-light " href="/profil">Profil Saya</a>
                        <a class="nav-link px-0 bg-white text-primarys fw-bold" href="login-no.html"><i
                                class='bx bx-log-out-circle'></i>
                            Keluar</a>
                    </li>
                </div>
                <li class="nav-item dropdown d-flex justify-content-center align-items-center m-0">
                    <a class="nav-link px-0" href="#">
                        <img class="rounded-circle img-thumbnail shadow-lg"
                            src="{{ asset('img/sekolah.jpg') }}"
                            alt="Profil" width="75">
                    </a>
                    <a id="name" class="nav-link dropdown-toggle fs-5" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @yanvios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item fw-bold" href="login-no.html"><i
                                    class="bi bi-box-arrow-left fw-bold"></i>
                                Keluar</a></li>

                    </ul>
                </li>
            </ul>
        </div>
        <!-- ======================= NAVBAR DROPDOWN ======================= -->

    </div>
</nav>