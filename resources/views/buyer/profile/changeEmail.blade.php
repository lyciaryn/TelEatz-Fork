@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar />
            </div>

            <div class="col-lg-9 d-flex flex-column gap-3">
                <x-header title="Ganti Email" />
                <div class="card shadow rounded-4 text-center py-4 px-3 d-flex align-items-center">
                    <form action="{{ route('buyer.profile.changeEmail.update', $profile->id) }}" method="POST"
                        enctype="multipart/form-data" style="width: 100%; max-width: 600px;">
                        @csrf
                        @method('PUT')
                        <div class="mb-4 text-start">
                            <label class="form-label">Email Lama</label>
                            <input type="email" name="oldEmail" class="form-control" placeholder="Email"
                                value="{{ $profile->email }}"readonly>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4 text-start">
                            <label class="form-label">Email Baru</label>
                            <input type="email" name="newEmail" class="form-control" placeholder="Email" required>
                        </div>

                        <!-- New Password Confirmation Input -->
                        <div class="mb-4 text-start">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Konfirmasi Password Untuk Save Email Baru" required>
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
