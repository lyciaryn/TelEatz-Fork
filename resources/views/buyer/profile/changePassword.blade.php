@extends('layouts.app')

@section('content')
    <x-navbarBuyer />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar />
            </div>

            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Ganti Password" />
                <x-breadcrumbs :links="[
                    ['label' => 'Home', 'url' => route('buyer.dashboard')],
                    ['label' => 'Profile Saya', 'url' => route('buyer.profile.menu')],
                    ['label' => 'Password'],
                ]" />
                <div class="card shadow rounded-4 text-center py-4 px-3 d-flex align-items-center">
                    <form action="{{ route('buyer.profile.changePassword.update', $profile->id) }}" method="POST"
                        enctype="multipart/form-data" style="width: 100%; max-width: 600px;">
                        @csrf
                        @method('PUT')

                        <!-- Old Password Input -->
                        <div class="mb-4 text-start">
                            <label class="form-label">Old Password</label>
                            <input type="password" name="oldPassword" class="form-control" placeholder="Password Lama"
                                required>
                        </div>

                        <!-- New Password Input -->
                        <div class="mb-4 text-start">
                            <label class="form-label">New Password</label>
                            <input type="password" name="newPassword" class="form-control" placeholder="Password Baru"
                                required>
                        </div>

                        <!-- New Password Confirmation Input -->
                        <div class="mb-4 text-start">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="newPassword_confirmation" class="form-control"
                                placeholder="Konfirmasi Password Baru" required>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-50 mx-2 rounded-pill">Simpan</button>
                            <button type="reset" class="btn btn-danger w-50 mx-2 rounded-pill">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-nav-bottom />
@endsection
