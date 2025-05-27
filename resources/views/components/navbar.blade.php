<nav class="navbar navbar-expand-lg d-flex p-lg-0 p-sm-3 shadow-sm bg-body fixed-top mb-6">
    <div class="container d-flex">
        {{-- ======================= MOBILE NAVBAR ======================= --}}
        <div class="d-flex d-lg-none align-items-center justify-content-between px-3 py-2 w-100">

            {{-- Profil Picture --}}
            <a class="nav-link px-0" href="#">
                @if (Auth::check() && Auth::user()->img)
                    <img src="{{ asset('images/' . Auth::user()->img) }}" alt="Profil"
                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.2);">
                @else
                    <div class="rounded-circle img-thumbnail shadow-sm"
                        style="width: 36px; height: 36px; background-color: #369a74; display: flex; align-items: center; justify-content: center;">
                        <span class="text-white" style="font-size: 14px;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1)) }}
                        </span>
                    </div>
                @endif
            </a>

            {{-- Aplikasi Title --}}
            <div class="text-center flex-grow-1 mx-2">
                <div class="fw-bold" style="color: var(--darkt); font-size: 1.1rem;">TelEatz</div>
            </div>

            {{-- Hamburger Toggle --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        {{-- ======================= DESKTOP NAVBAR ======================= --}}
        <div class="d-none d-lg-flex align-items-center justify-content-between px-4 py-2 w-100">

            {{-- Title & Subjudul --}}
            <div class="d-flex flex-column">
                <span class="fw-bold fs-3" style="color: var(--darkt);">TelEatz <span class="text-secondary fs-5">Telkom
                        University</span></span>
            </div>

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
                        <a class="nav-link px-0 text-light " href="{{ route('admin.dashboard') }}">Home</a>
                        <a class="nav-link px-0 text-light " href="{{ route('admin.kelola_akun.index') }}">Kelola
                            User</a>
                        <a class="nav-link px-0 text-light " href="{{ route('admin.kategori.index') }}">Kelola
                            Kategori</a>
                        <a class="nav-link px-0 text-light " href="{{ route('admin.transaction') }}">Histori
                            Transaksi</a>
                        <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <!-- Tombol logout -->
                        <a href="#" class="nav-link px-0 bg-white text-primarys fw-bold"
                            onclick="event.preventDefault(); confirmLogout()"><i
                                class='bx bx-log-out-circle'></i><b>Logout</b></a>

                    </li>
                </div>


                <li class="nav-item dropdown d-flex justify-content-center align-items-center m-0">



                    <a class="nav-link px-0" href="#">
                        @if (Auth::check() && Auth::user()->img)
                            <img src="{{ asset('images/' . Auth::user()->img) }}" alt="Profil"
                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.2);">
                        @else
                            <div class="rounded-circle img-thumbnail shadow-lg"
                                style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #369a74;">
                                <span class="text-light" style="font-size: 18px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1)) }}
                                </span>
                            </div>
                        @endif
                    </a>


                    <a id="name" class="nav-link dropdown-toggle fs-6" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->email }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('buyer.profile.profile_buyer') }}">Profil</a>
                        </li>
                        <li>
                            <!-- Form logout tersembunyi -->
                            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <!-- Tombol logout -->
                            <a href="#" class="dropdown-item text-danger"
                                onclick="event.preventDefault(); confirmLogout()"><b>Logout</b></a>
                        </li>
                    </ul>



            </ul>
            </li>
            </ul>
        </div>
        <!-- ======================= NAVBAR DROPDOWN ======================= -->

    </div>
</nav>
