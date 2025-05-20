<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaMakananController extends Controller
{
    public function index(Request $request)
    {
        $makanan = Product::where('seller_id', auth::id());

                // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $makanan->where(function ($q) use ($search) {
                $q->where('nama_product', 'like', "%$search%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        // Filter kategori
        if ($request->filled('category')) {
            $makanan->whereHas('category', function ($q) use ($request) {
                $q->where('nama_kategori', $request->category);
            });
        }

        $makanan = $makanan->get();
        $categories = Category::all(); // ambil semua kategori dari DB
        
        return view('seller.KelolaMakanan.KelolaMakanan_seller', compact('makanan', 'categories'));
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
                'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $makanan = new Product();
            $makanan->seller_id = auth::id();
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
        $makanan = Product::findOrFail($id);
        return view('seller.KelolaMakanan.KelolaMakanan_showdetail', compact('makanan'));
    }

    public function edit($id)
    {
        $makanan = Product::find($id);
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
            $makanan = Product::findOrFail($id);

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
        $makanan = Product::findOrFail($id);
        $makanan->delete();
        return redirect()->back()->with('deletesuccess', 'Menu makanan berhasil dihapus');
    }

    public function destroy($id)
    {

        $makanan = Product::findOrFail($id);
        $makanan->delete();
        return redirect()->back()->with('justsuccess', 'Item berhasil dihapus dari daftar menu.');
    }
}
