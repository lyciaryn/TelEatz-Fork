<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'role' => 'required|in:buyer,seller',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role = $validated['role'];

        // Atur email_verified_at kalau buyer
        if ($validated['role'] === 'buyer') {
            $user->email_verified_at = now();
        }

        $user->save();

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
