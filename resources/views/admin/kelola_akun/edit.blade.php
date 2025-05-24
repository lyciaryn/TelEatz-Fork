@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('admin.kelola_akun.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- agar dikenali sebagai method update -->

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.kelola_akun.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
