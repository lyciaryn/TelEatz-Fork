<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $users->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $users->where('role', $request->role);
        }

        // Filter by verification status
        if ($request->has('verified')) {
            if ($request->verified == '1') {
                $users->whereNotNull('email_verified_at');
            } elseif ($request->verified == '0') {
                $users->whereNull('email_verified_at');
            }
        }

        $users = $users->orderBy('created_at', 'desc')->get();

        return view('admin.kelola_akun.index', compact('users'));
    }


    public function create()
    {
        return view('admin.kelola_akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.kelola_akun.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.kelola_akun.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.kelola_akun.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if ($user->email_verified_at) {
            // User sudah verified → soft delete

            // Update is_open dan email null
            $user->is_open = false;
            $user->email = null;
            $user->save();

            // Set produk user jadi tidak tersedia
            $user->products()->update(['is_available' => false]);

            // Soft delete user
            $user->delete();

            $message = 'User verified berhasil di hapus, produk dinonaktifkan.';
        } else {
            // User belum verified → hapus permanen

            // Hapus semua produk user permanen
            $user->products()->delete();

            // Hapus user permanen
            $user->forceDelete();

            $message = 'User not verified telah dihapus permanen.';
        }

        return redirect()->route('admin.kelola_akun.index')->with('success', $message);
    }
}
