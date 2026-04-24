@extends('layouts.app')


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/yv2.png" type="image/x-icon">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <script src="https://kit.fontawesome.com/e51a3b91d6.js" crossorigin="anonymous"></script>
</head>
@section('content')
    <!-- form login -->

    <div class="canvas-log animate__animated animate__fadeIn">
        <div class="left-sec">
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player src="https://lottie.host/4e2cd31d-1fac-42b1-8d94-84565c925c08/YAAGuE6FAB.lottie"
                background="transparent" speed="1" style="width: 420px; height: 420px" loop
                autoplay></dotlottie-player>
        </div>
        <div class="right-sec">
            <h1 style="color: #1092FE;" class="animate__animated animate__fadeInUp"><b>Login</b></h1>
            <p class="animate__animated animate__fadeInUp"><span style=" color: var(--fbluet); font-weight: bold;"
                    class="">Login</span> untuk masuk ke TelEats!
            </p>
            <div class="input-data">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-container text-center animate__animated animate__fadeInLeft">
                        <input type="email" name="email" placeholder="Masukkan Email" required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-user"></i>
                        </button>
                    </div>
                    <div class="input-container text-center animate__animated animate__fadeInRight">
                        <input type="password" name="password" placeholder="Masukkan Password" required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-key"></i>
                        </button>
                    </div>
                    <div class="button text-center animate__animated animate__fadeInUp mt-5">
                        <button class="submit text-light w-100 mb-5" type="submit">
                            Login
                        </button>
                    </div>
                    <p class="text-secondary text-center">Don't have an account? <a href="{{ route('register') }}">Sign
                            Up</a></p>
                    <p class="text-secondary text-center mt-3 "><a href="{{ route('password.request') }}">Forgot
                            Password</a>
                    </p>
                </form>

            </div>



            <a href="{{ route('buyer.landing') }}"
                style="position: fixed; bottom: 20px; left: 20px;
                   background-color: #1092FE; color: white;
                   padding: 8px 12px; border-radius: 8px;
                   font-size: 14px; text-decoration: none;
                   display: flex; align-items: center;
                   box-shadow: 0 2px 6px rgba(0,0,0,0.15);
                   z-index: 999;">
                <i class='bx bx-arrow-back' style="font-size: 18px; margin-right: 6px;"></i> Kembali
            </a>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
@endsection
