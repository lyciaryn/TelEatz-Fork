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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->

    <script src="https://kit.fontawesome.com/e51a3b91d6.js" crossorigin="anonymous"></script>
</head>
@section('content')
    <!-- form login -->

    <div class="canvas-log animate__animated animate__fadeIn">
        <div class="left-sec">
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player src="https://lottie.host/f590e3bb-fa83-4f0a-9bcd-ea506a5b4a91/pEQ48RBjDJ.lottie"
                background="transparent" speed="1" style="width: 500px; height: 500px" loop autoplay
                class="animate__animated animate__fadeInUp"></dotlottie-player>
        </div>
        <div class="right-sec">
            <h1 class="animate__animated animate__fadeInUp"><b>Lupa Password</b></h1>
            <p>Silahkan Masukkan Email Anda</p>
            <div class="input-data">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-container
                    text-center animate__animated animate__fadeInLeft">
                        <input type="email" name="email" placeholder="Masukkan Email" required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-user"></i>
                        </button>
                    </div>
                    @error('email')
                        <div class="text-danger small ms-1 mb-2" style="font-size: 11px">{{ $message }}</div>
                    @enderror

                    <div class="button text-center animate__animated animate__fadeInUp mt-2 mb-5">
                        <button class="submit text-light w-100 " type="submit">
                            Kirim Link Reset
                        </button>
                    </div>

                    <a href="{{ route('login') }}"
                        style="font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; margin-top: 2rem; color: var(--fblue); ">
                        <i class='bx btn btn-primary bx-chevron-left me-3'
                            style="font-size: 16px; margin-right: 4px; color: "></i>
                        kembali ke login
                    </a>

                </form>
            </div>



        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
@endsection
