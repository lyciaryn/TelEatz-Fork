{{-- <form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ request('email') }}" readonly required>

    </div>

    <div>
        <label>Password Baru</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Reset Password</button>
</form> --}}




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
    <div class="canvas-log animate__animated animate__fadeIn">
        <div class="left-sec">
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player src="https://lottie.host/f590e3bb-fa83-4f0a-9bcd-ea506a5b4a91/pEQ48RBjDJ.lottie"
                background="transparent" speed="1" style="width: 500px; height: 500px" loop autoplay
                class="animate__animated animate__fadeInUp"></dotlottie-player>
        </div>
        <div class="right-sec">
            <h1 class="animate__animated animate__fadeInUp"><b>Password Baru</b></h1>
            <p>Buat Password Baru Untuk Anda!</p>
            <div class="input-data">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-container
                    text-center animate__animated animate__fadeInLeft">
                        <input class="form-control" type="email" name="email" value="{{ request('email') }}" readonly
                            required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-user"></i>
                        </button>
                    </div>
                    {{-- Password --}}
                    <div class="input-container text-center ">
                        <input type="password" name="password" placeholder="Masukkan Password"
                            class="@error('password') is-invalid @enderror" required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-key"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1 ms-1" style="font-size: 11px">{{ $message }}</div>
                    @enderror

                    {{-- Konfirmasi Password --}}
                    <div class="input-container text-center  ">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-key"></i>
                        </button>
                    </div>
                    <div class="button text-center animate__animated animate__fadeInUp mt-2">
                        <button class="submit text-light w-100 " type="submit">
                            Kirim Link Reset
                        </button>
                    </div>

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
