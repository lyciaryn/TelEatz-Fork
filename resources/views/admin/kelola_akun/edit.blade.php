@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_admin />
            </div>

            <div class="col-lg-9">
                <x-header title="Edit User" />

                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Tampilkan error jika ada -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.kelola_akun.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
                                <input type="hidden" name="role" value="{{ $user->role }}"> {{-- tetap dikirim ke controller --}}
                            </div>

                            <div class="mb-3 d-flex align-items-center gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="verified" id="verified" value="1"
                                        {{ $user->email_verified_at ? 'checked' : '' }}>

                                </div>
                                <label>Verifikasi User</label>
                            </div>


                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.kelola_akun.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-nav-bottom />
@endsection
