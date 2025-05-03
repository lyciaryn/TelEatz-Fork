<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\KelolaMakanan;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaMakananController extends Controller
{
    public function index()
    {
        $makanan = KelolaMakanan::where('seller_id', 2)->get();
        return view('seller.KelolaMakanan.KelolaMakanan_seller', compact('makanan'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_product' => 'required',
                'harga' => 'required|numeric',
                'deskripsi' => 'required',
                'is_available' => 'required|boolean',
                'category_id' => 'required|exists:categories,id',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $makanan = new KelolaMakanan();
            $makanan->seller_id = 2;
            $makanan->nama_product = $request->nama_product;
            $makanan->harga = $request->harga;
            $makanan->deskripsi = $request->deskripsi;
            $makanan->is_available = $request->is_available;
            $makanan->category_id = $request->category_id;
            $makanan->created_at = now();
            $makanan->updated_at = now();

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $makanan->img = $filename;
            }

            $makanan->save();

            return redirect()->back()->with('success', 'produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error');
        }
    }

    public function fetchcategory()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();

        // Kirim kategori ke view
        return view('seller.KelolaMakanan.KelolaMakanan_create', compact('categories'));
    }

    public function showingdetail($id)
    {
        $makanan = KelolaMakanan::findOrFail($id);
        return view('seller.KelolaMakanan.KelolaMakanan_showdetail', compact('makanan'));
    }

    public function edit($id)
    {
        $makanan = KelolaMakanan::find($id);
        return view('seller.KelolaMakanan.KelolaMakanan_edit', compact('makanan'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'nama_product' => 'required',
                'harga' => 'required|numeric',
                'deskripsi' => 'required',
                'is_available' => 'required|boolean',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional

            ]);

            // Temukan data berdasarkan ID
            $makanan = KelolaMakanan::findOrFail($id);

            // Update data
            $makanan->nama_product = $request->nama_product;
            $makanan->harga = $request->harga;
            $makanan->deskripsi = $request->deskripsi;
            $makanan->is_available = $request->is_available;
            $makanan->updated_at = now();

            // Jika ada gambar baru, simpan gambar
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $makanan->img = $filename;
            }

            $makanan->save();

            return redirect()->route('kelolamakanan.edit', ['id' => $makanan->id])->with('success', 'Menu makanan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function delete($id)
    {
        $makanan = KelolaMakanan::findOrFail($id);
        $makanan->delete();
        return redirect()->back()->with('deletesuccess', 'Menu makanan berhasil dihapus');
    }

    public function destroy($id)
    {
        $makanan = KelolaMakanan::findOrFail($id);
        $makanan->delete();
        return redirect()->route('kelolamakanan.delete')->with('success', 'Menu makanan berhasil dihapus');
    }
}
