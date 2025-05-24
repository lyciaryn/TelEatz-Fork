<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Makanan;
use App\Models\User;

use Carbon\Carbon;

use Exception;
use Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::where('id', auth::id())->first();
        if ($profile->open_time || $profile->close_time) {
            $profile->open_time = \Carbon\Carbon::createFromFormat('H:i:s', $profile->open_time)->format('H:i');
            $profile->close_time = \Carbon\Carbon::createFromFormat('H:i:s', $profile->close_time)->format('H:i');
        } else {
            $profile->open_time = null;
            $profile->close_time = null;
        }

        return view('seller.Profile.menu', compact('profile'));
    }

    public function update(Request $request, $id)
    {


        try {
            // Validasi input
            $request->validate([
                'name' => 'string|max:255',
                'email' => 'nullable|email|max:255',
                'open_time' => 'nullable|date_format:H:i',
                'close_time' => 'nullable|date_format:H:i|after:open_time',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional
            ]);

            // Temukan data berdasarkan ID
            $profile = User::findOrFail($id);

            // Update data
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->open_time = $request->open_time;
            $profile->close_time = $request->close_time;
            $profile->updated_at = now();

            // Jika ada gambar baru, simpan gambar
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $profile->img = $filename;
            }

            $waktu_sekarang = Carbon::now();
            if ($waktu_sekarang->between($request->close_time, $request->open_time))
            {
                $profile->is_open = 1; // buka
            } else {
                $profile->is_open = 0; // tutup
            }

            $profile->save();

            return redirect()->route('seller.profile', ['id' => $profile->id])->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }
    public function changePasswordIndex()
    {
        // Temukan data berdasarkan ID
        $profile = User::where('id', auth::id())->first();
        return view('seller.Profile.changePassword', compact('profile'));
    }

    public function changePassword(Request $request, $id)
    {
        try {
            // Pastikan user terautentikasi
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
            }

            // Validasi input
            $request->validate([
                'oldPassword' => 'required',
                'newPassword' => 'required|min:5|confirmed',
            ]);

            // Ambil data user berdasarkan ID
            $profile = User::findOrFail($id); // atau bisa berdasarkan $id jika diperlukan

            // Validasi password lama
            if (!Hash::check($request->oldPassword, $profile->password)) {
                return redirect()->route('seller.profile.changePassword')->with('error', 'Password lama tidak sesuai');
            }

            // Pastikan password baru tidak sama dengan password lama
            if ($request->oldPassword == $request->newPassword) {
                return redirect()->route('seller.profile.changePassword')->with('error', 'Password baru tidak boleh sama dengan password lama');
            }

            // Update password baru setelah hash
            $profile->password = Hash::make($request->newPassword);
            $profile->save();

            // Redirect ke halaman edit profil dengan pesan sukses
            return redirect()->route('seller.profile.changePassword')->with('success', 'Password berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    public function changeEmailIndex()
    {
        // Temukan data berdasarkan ID
        $profile = User::where('id', auth::id())->first();
        return view('seller.Profile.changeEmail', compact('profile'));
    }

    public function changeEmail(Request $request, $id)
    {
        $profile = User::findOrFail($id);
        try {
            // Validasi input
            $request->validate([
                'newEmail' => 'required|email|max:255',
                'password' => 'required'
            ]);

            // Temukan data berdasarkan ID
            $profile = User::findOrFail($id);


            if (!Hash::check($request->password, $profile->password)) {
                return redirect()->route('seller.profile.changeEmail')->with('error', 'Password lama tidak sesuai');
            }

            // Update email
            $profile->email = $request->newEmail;
            $profile->save();

            return redirect()->route('seller.profile.changeEmail')->with('success', 'Email berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }
}
