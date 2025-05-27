<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Teleatz</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('img/Teleatz1-white-full.png') }}">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <style>
        a {
            text-decoration: none !important;
        }

        .icon-box {
            position: relative;
            background: #e0f2e9;
            border-radius: 15px;
            padding: 30px;
            overflow: hidden;
            height: 200px;
        }

        .icon-box .icon {
            position: absolute;
            bottom: -50px;
            right: -20px;
            font-size: 300px;
            /* Lebih besar lagi */
            color: rgba(0, 0, 0, 0.05);
            line-height: 1;
            pointer-events: none;
            z-index: 0;
            transform: translate(10%, 10%);
        }

        .icon-box .title {
            position: relative;
            z-index: 1;
            font-weight: 600;
            font-size: 1.8rem;
            color: #2d2d2d;
        }
    </style>

</head>

<body class="index-page">
    <header id="header" class="header fixed-top">
        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href=""
                    class="logo d-flex align-items-center d-lg-flex justify-content-center align-content-center gap-1 ">
                    <img src="{{ asset('img/Teleatz1-solidwhite.png') }}" alt="" srcset="">
                    <h1 class="sitename">TelEatz</h1>
                    <span>.</span>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a style="text-decoration:none;" href="#home" class="active">Home<br></a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a style="color:#1092FE" class="btn btn-light px-4 py-2 fw-bold"
                                href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>

        </div>

    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="home" class="hero section accent-background">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-5 justify-content-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2><span>Welcome to </span><span class="accent">TelEatz!</span></h2>
                        <p>Website E-Canteen yang diberi nama TelEatz, merupakan platform digital agar memudahkan anda
                            saat melakukan pemesanan secara online, meilhat menu dari berbagai kedai.</p>
                        <div class="d-flex">
                            <a href="#about" class="btn-get-started fw-bold">Get Started</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <dotlottie-player class="img-fluid w-100 h-100"
                            src="https://lottie.host/5bb89dd5-4418-4d8a-9291-cb12617e32cb/HAqXrhC6aG.lottie"
                            background="transparent" speed="1" loop autoplay>
                        </dotlottie-player>

                    </div>
                </div>
            </div>
            <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
                <div class="container position-relative">
                    <div class="row gy-4 mt-5">

                        <div class="col-xl-6 col-md-6">
                            <div class="icon-box">
                                <div class="icon"><i style="font-size: 10rem; opacity: 50%"
                                        class='bx bxs-bowl-hot'></i></div>
                                <h4 class="title"><a href="" class="stretched-link"
                                        style="cursor: default;">Lihat Makanan😍​</a></h4>
                            </div>

                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="icon-box">
                                <div class="icon"><i style="font-size: 10rem; opacity: 50%"
                                        class='bx bxs-food-menu'></i></div>
                                <h4 class="title"><a href="" class="stretched-link"
                                        style="cursor: default;">Pesan Makanan😋​</a></h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about">

            <!-- Section Title -->
            <div class="container section-title text-center" data-aos="fade-up">
                <h2 style="color: #1092FE;" class="fw-bold">Tentang Kami</h2>
                <p class="text-muted">Membawa pengalaman baru dalam memesan makanan di kantin kampus.</p>
            </div><!-- End Section Title -->

            <div class="container py-4">
                <div class="row align-items-center gy-4">
                    <!-- Gambar Logo -->
                    <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('img/Teleatz1-primary.png') }}" class="img-fluid"
                            style="max-width: 400px;" alt="Logo TelEatz">
                    </div>

                    <!-- Konten Teks -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="fw-semibold mb-3">Apa itu <span style="color: #1092FE;">TelEatz?</span> </h3>
                        <p>
                            <strong>TelEatz</strong> adalah platform <em>e-canteen</em> berbasis web yang memudahkan
                            pemesanan makanan di lingkungan kampus secara online.
                            Tanpa perlu antre, pengguna dapat memilih menu, melakukan pembayaran, dan mengambil makanan
                            saat sudah siap.
                        </p>
                        <ul class="list-unstyled ms-5">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Pesan makanan
                                secara online dari berbagai kedai</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Lihat menu,
                                deskripsi, dan estimasi waktu penyajian</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Dukungan
                                pembayaran tunai dan QRIS</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Minim antrean,
                                maksimal efisiensi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section><!-- /About Section -->

        <section id="features" class="features mb-4  ">
            @php
                use App\Models\Product;

                $products = Product::all();
            @endphp
            <div class="container my-5">
                <div class="container section-title text-center" data-aos="fade-up">
                    <h2 style="color: #1092FE;" class="mb-4 text-center">Menu Makanan Populer</h2>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="row justify-content-center" style="max-width: 1200px;">
                        @php
                            $products = \App\Models\Product::take(4)->get(); // tampilkan maksimal 4 produk
                        @endphp

                        @forelse ($products as $product)
                            <div class="col-md-3 col-sm-6 mb-4 d-flex">
                                <div class="card shadow-sm no-outline w-100 border-0">
                                    <div class="p-2">
                                        <img src="{{ asset('images/' . $product->img) }}" class="img-fluid rounded"
                                            alt="{{ $product->nama }}"
                                            style="height: 160px; object-fit: cover; width: 100%;">
                                    </div>
                                    <div class="card-body text-center">
                                        <h6 class="card-title fw-bold">{{ $product->nama }}</h6>
                                        <p class="card-text small text-muted">
                                            {{ \Illuminate\Support\Str::limit($product->deskripsi, 60) }}
                                        </p>
                                        <a href="{{ route('login') }}"
                                            class="btn btn-sm text-white mt-2 rounded-pill px-3 py-2 fw-bold"
                                            style="background-color: #1092FE;">Pesan
                                            Sekarang</a>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="col-12">
                                <p class="text-center">Belum ada produk tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </section>





    </main>

    <footer id="footer" class="footer accent-background">

        <div class="container footer-top">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-6 mb-4 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">TelEatz</span>
                    </a>
                    <p>
                        Website E-Canteen yang diberi nama TelEatz, merupakan platform digital agar memudahkan anda saat
                        melakukan pemesanan secara online, melihat menu dari berbagai tenant, mengetahui ketersediaan
                        makanan, dan juga melakukan pembayaran secara non-tunai dengan praktis.
                    </p>
                    <div class="social-links d-flex mt-4">
                        <a href="https://www.instagram.com/telkomuniversity/" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="col-md-6 footer-contact text-start">
                    <h4>Contact Us</h4>
                    <p>Jl. Telekomunikasi No. 1, Bandung Terusan Buahbatu - Bojongsoang, Sukapura, Kec. Dayeuhkolot,
                        Kabupaten Bandung, Jawa Barat 40257</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>+62 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>telkom@university</span></p>
                </div>
            </div>
        </div>


        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">TelEatz</strong> <span>All Rights
                    Reserved</span>
            </p>
            <div class="credits">
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

</body>

</html>
