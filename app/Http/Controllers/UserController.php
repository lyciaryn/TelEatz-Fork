<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'role' => 'required|in:admin,seller,buyer',
        'password' => 'required|min:5',
        'email_verified_at' => now()
    ]);

    $user = new User();
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->password = bcrypt($validated['password']);
    $user->role = $validated['role'];
    $user->email_verified_at = now();
    $user->is_open = false;
    $user->save();

    return redirect()->route('admin.kelola_akun.index')->with('success', 'User berhasil ditambahkan.');
}

    public function edit(User $user)
    {
        return view('admin.kelola_akun.edit', compact('user'));
    }

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,seller,buyer',
        'password' => 'nullable|min:6',
        'verified' => 'nullable|boolean', // untuk checkbox
    ]);

    // Update field dasar
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];

    // Update password jika diberikan
    if (!empty($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }

    // Update status verifikasi
    if ($request->has('verified') && $validated['verified']) {
        $user->email_verified_at = now();
    } else {
        $user->email_verified_at = null;
    }

    $user->save();

    return redirect()->route('admin.kelola_akun.index')->with('success', 'User berhasil diupdate.');
}


public function destroy(User $user)
{
    // Cek apakah user memiliki order dengan status "diproses"
    $hasProcessingOrder = DB::table('orders')
        ->where('buyer_id', $user->id)
        ->where('status', 'diproses')
        ->exists();

    if ($hasProcessingOrder) {
        return redirect()
            ->route('admin.kelola_akun.index')
            ->with('error', 'User tidak dapat dihapus karena masih memiliki pesanan.');
    }

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

        $message = 'User verified berhasil dihapus, produk dinonaktifkan.';
    } else {
        // User belum verified → hapus permanen

        // Hapus semua produk user permanen
        $user->products()->delete();

        // Hapus user permanen
        $user->forceDelete();

        $message = 'User not verified telah dihapus permanen.';
    }

    return redirect()->route('admin.kelola_akun.index')->with('success', $message);
}}
