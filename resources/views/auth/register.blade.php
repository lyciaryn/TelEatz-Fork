@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/yv2.png" type="image/x-icon">
    <title>Register Page</title>
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
            <h1 class="animate__animated animate__fadeInUp"><b>Register</b></h1>
            <p class="animate__animated animate__fadeInUp"><span style=" color: var(--fbluet); font-weight: bold;"
                    class="">Register</span> untuk masuk ke TelEats!
            </p>
            <div class="input-data">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center w-100" style="gap: 10px;">
                        <div class="logo-select" style="font-size: 35px; color: var(--fblue);">
                            <i class='bx bxs-id-card'></i>
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-select text-secondary fw-bold border-0 w-100" name="role" id="role"
                                style="font-size: 13px; padding: 13px 10px; border-radius: 20px; " required>
                                <option disabled {{ old('role') ? '' : 'selected' }}>Daftar Sebagai...</option>
                                <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
                                <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>

                            </select>
                        </div>
                    </div>
                    @error('role')
                        <div class="text-danger small mt-1 ms-1" style="font-size: 11px">
                            {{ $message }}
                        </div>
                    @enderror



                    {{-- Username --}}
                    <div class="input-container text-center ">
                        <input type="text" name="name" placeholder="Masukkan Username" value="{{ old('name') }}"
                            class="@error('name') is-invalid @enderror" required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-user"></i>
                        </button>
                    </div>
                    @error('name')
                        <div class="text-danger small mt-1 ms-1" style="font-size: 11px">{{ $message }}</div>
                    @enderror

                    {{-- Email --}}
                    <div class="input-container text-center ">
                        <input type="email" name="email" placeholder="name@example.cpm" value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror" required>
                        <button class="invite-btn" type="button" tabindex="-1">
                            <i class="fa-solid fa-user"></i>
                        </button>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1 ms-1" style="font-size: 11px">{{ $message }}</div>
                    @enderror

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

                    {{-- Tombol Submit --}}
                    <div class="button text-center animate__animated animate__fadeInUp mt-5">
                        <button class="submit text-light w-100 mb-5" type="submit">
                            Sign Up
                        </button>
                    </div>

                    <p class="text-secondary text-center">
                        Already have an Account? <a href="{{ route('login') }}">Login</a>
                    </p>
                </form>

            </div>



        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
@endsection
