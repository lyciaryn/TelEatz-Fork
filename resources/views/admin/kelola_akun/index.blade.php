@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container">
        <div class="row dash" style="margin-top: 100px;">
            <div class="col-lg-3 pos">
                <x-sidebar_admin />
            </div>

            <div class="col-lg-9 d-flex flex-column gap-3">

                <x-header title="Kelola Akun User" />

                <x-breadcrumbs :links="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Kelola User']]" />

                <!-- Tombol Tambah User -->
                <div>
                    <a href="{{ route('admin.kelola_akun.create') }}" class="btn btn-primary mb-3">+ Tambah User</a>
                </div>

                <!-- Tabel User -->
                <div class="card shadow-sm">
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <!-- Form Filter & Search -->
                        <form method="GET" class="row g-2 mb-3">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Cari nama atau email...">
                            </div>
                            <div class="col-md-3">
                                <select name="role" class="form-select">
                                    <option value="">Semua Role</option>
                                    <option value="buyer" {{ request('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
                                    <option value="seller" {{ request('role') == 'seller' ? 'selected' : '' }}>Seller
                                    </option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="verified" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('verified') == '1' ? 'selected' : '' }}>Terverifikasi
                                    </option>
                                    <option value="0" {{ request('verified') == '0' ? 'selected' : '' }}>Belum
                                        Verifikasi</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                                <a href="{{ route('admin.kelola_akun.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>

                        @if ($users->count())
                            <table class="table table-bordered table-striped small">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Verified</th>
                                        <th scope="col">Join Date</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.kelola_akun.edit', $user->id) }}"
                                                    class="badge rounded-pill text-white {{ $user->email_verified_at ? 'bg-success' : 'bg-danger' }}"
                                                    style="text-decoration: none;">
                                                    {!! $user->email_verified_at ? '&#9989; Verified' : '&#10060; Not Verified' !!}
                                                </a>
                                            </td>

                                            <td>{{ $user->created_at }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.kelola_akun.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm rounded-pill"><i
                                                        class='bx bxs-edit-alt'></i></a>
                                                <form action="{{ route('admin.kelola_akun.destroy', $user->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class='bx bxs-trash'></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center text-muted">Tidak ada user terdaftar.</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <x-nav-bottom_admin />
    @endsection
