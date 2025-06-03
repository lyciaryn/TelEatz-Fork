<div class="card-nav card mb-3 animate_animated animate_fadeInUp" style="position: sticky; top: 101px; z-index: 100;">
    <div class="card-body nav-dash d-flex flex-column text-decoration-none gap-3 ">
        <div class=" nav-2 sidebar-profile d-flex justify-content-start align-items-center py-3  px-3">
            @if(Auth::check() && Auth::user()->img)
            <img class="rounded-circle img-thumbnail shadow-lg"
                src="{{ asset('storage/' . Auth::user()->img) }}"
                alt="Profil" style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
            @else
                <div class="rounded-circle img-thumbnail shadow-lg" style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #369a74;">
                    <span class="text-light" style="font-size: 18px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1)) }}
                    </span>
                </div>
             @endif

            <div class="nav-link ms-3" href="">
                <p id="username-sidebar" style="font-size: 17px;" class="fw-bold text-light">{{ Auth::user()->name }}</p>
                <p style="font-size: 13px;" class="text-light">{{ Auth::user()->role }} <i class='bx bxs-check-shield p-0 m-0'></i></p>
            </div>

        </div>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('seller.dashboard') }}"><i class='bx bx-home-alt me-2'></i> 
            <p style="font-size: 14px;">Home</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('kelolamakanan') }}"><i class='bx bx-food-menu me-2'></i>
            <p style="font-size: 14px;">Kelola Menu</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('seller.pesanan')}}"><i class='bx bx-cart me-2'></i>
            <p style="font-size: 14px;">Pesanan</p>
        </a>
        <div class="border-top"></div>



        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('seller.pesanan.history') }}"><i class='bx bx-history me-2'></i>
            <p style="font-size: 14px;">Histori Pesanan</p>
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{route('seller.review')}}"><i class='bx bx-star me-2'></i>
            <p style="font-size: 14px;">Ulasan</p>
        <a class="nav-link d-flex align-items-center gap-2" href="{{route('seller.profile')}}"><i class='	bx bx-user me-2'></i>
            <p style="font-size: 14px;">Profil Saya</p>
        </a>
        <div class="border-top"></div>
        <a style="color: #c38484" class="nav-link d-flex align-items-center gap-2 mt-1" href="#" onclick="event.preventDefault(); confirmLogout()">
            <i style="background-color: rgb(232, 108, 108)" class='bx bx-log-out me-2'></i> Logout

            <!-- Form logout tersembunyi -->
            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </a>
    </div>
</div>
