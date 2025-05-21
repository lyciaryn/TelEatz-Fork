<div class="card-nav card mb-3 animate_animated animate_fadeInUp">
    <div class="card-body nav-dash d-flex flex-column text-decoration-none gap-3 ">
        <div class=" nav-2 sidebar-profile d-flex justify-content-start align-items-center py-3  px-3">

            @if (Auth::check() && Auth::user()->profile_picture)
                <img class="rounded-circle img-thumbnail shadow-lg"
                    src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profil"
                    width="50">
            @else
                <div class="rounded-circle img-thumbnail shadow-lg"
                    style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #369a74;">
                    <span class="text-light" style="font-size: 18px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1)) }}
                    </span>
                </div>
            @endif

            <div class="nav-link ms-3" href="">
                <p id="username-sidebar" style="font-size: 17px;" class="fw-bold text-light">{{ Auth::user()->name }}
                </p>
                <p style="font-size: 13px;" class="text-light">{{ Auth::user()->role }} <i
                        class='bx bxs-check-shield p-0 m-0'></i></p>
            </div>

        </div>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}"><i
                class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Home</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.kelolauser.index') }}"><i
                class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Kelola User</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.kategori.index') }}"><i
                class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Kelola Kategori</p>
        </a>
        <div class="border-top"></div>



        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.transaction') }}"><i
                class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Semua Transaksi</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('seller.profile') }}"><i
                class='bx bx-home-alt me-2'></i>
            <p style="font-size: 14px;">Profil Saya</p>
        </a>
        <div class="border-top"></div>
        <a style="color: #c38484" class="nav-link d-flex align-items-center gap-2 mt-1" href="#"
            onclick="event.preventDefault(); confirmLogout()">
            <i style="background-color: rgb(232, 108, 108)" class='bx bx-log-out me-2'></i> Logout

            <!-- Form logout tersembunyi -->
            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </a>
    </div>
</div>
