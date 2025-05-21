<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Impact Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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
    </style>

</head>

<body class="index-page">
    <header id="header" class="header fixed-top">
        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <h1 class="sitename">TelEatz</h1>
                    <span>.</span>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a style="text-decoration:none;" href="#home" class="active">Home<br></a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
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
        <section id="hero" class="hero section accent-background">
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
                    <div class="row gy-2 mt-5">

                        <div class="col-xl-6 col-md-6">
                            <div class="icon-box">
                                <div class="icon"><i class='bx bxs-bowl-hot'></i></div>
                                <h4 class="title"><a href="" class="stretched-link">Lihat Makanan</a></h4>
                            </div>
                        </div><!--End Icon Box -->

                        <div class="col-xl-6 col-md-6">
                            <div class="icon-box">
                                <div class="icon"><i class='bx bxs-food-menu'></i></div>
                                <h4 class="title"><a href="" class="stretched-link">Pesan Makanan</a></h4>
                            </div>
                        </div><!--End Icon Box -->

                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>About Us<br></h2>
                {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h3>Apa itu Tel-Eatz?</h3>
                        <img src="{{ asset('img/about.jpg" class="img-fluid rounded-4 mb-4') }}" alt="">
                        <p>Website E-Canteen yang diberi nama TelEatz, merupakan platform digital agar memudahkan anda
                            saat melakukan pemesanan secara online, meilhat menu dari berbagai kedai.</p>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Bisa pesan makanan</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>bisa lihat keda1</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Bisa lihat</span></li>
                            </ul>


                            <div class="position-relative mt-4">
                                <img src="{{ asset('img/about-2.jpg') }}" class="img-fluid rounded-4"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section">

            <div class="container">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
                </div>

            </div>

        </section><!-- /Clients Section -->

    </main>

    <footer id="footer" class="footer accent-background">

        <div class="container footer-top">
            <div class="d-flex justify-content-between">
                <div class="col-lg-5 col-md-12 footer-about ">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">TelEatz</span>
                    </a>
                    <p>Website E-Canteen yang diberi nama TelEatz, merupakan platform digital agar memudahkan anda saat
                        melakukan pemesanan secara online, meilhat menu dari berbagai tenant, mengetahui ketersediaan
                        makanan, dan juga melakukan pembayaran secara non-tunai dengan praktis.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
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
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a
                    href="https://themewagon.com">ThemeWagon</a> --}}
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

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

</body>

</html>
