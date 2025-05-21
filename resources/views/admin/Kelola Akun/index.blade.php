<!-- resources/views/users/index.blade.php -->

@extends('layouts.app') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')
    <div class="container">
        <h1>Daftar User</h1>

        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($users->count())
            <ul class="list-group">
                @foreach ($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $user->name }}</strong> - {{ $user->email }}
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Tidak ada user terdaftar.</p>
        @endif
    </div>
@endsection
