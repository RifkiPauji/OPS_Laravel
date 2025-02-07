<?php

namespace App\Http\Controllers\ProductController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategori = DB::connection('postgres')->table('kategori')->get();
        // Ambil data produk dengan kategori dari database PostgreSQL
        $results = DB::connection('postgres')->table('product as a')
            ->leftJoin('kategori as b', 'b.kode_kategori', '=', 'a.kategori')
            ->select([
                'a.id',
                'a.nama_product',
                'b.nama_kategori',
                'a.harga_beli',
                'a.harga_jual',
                'a.stock',
                'a.poto_product',
            ])
            ->get();

        return view('product.index', compact('results','kategori'));
    }

    public function create()
    {
        // Ambil data kategori dari PostgreSQL
        $kategori = DB::connection('postgres')->table('kategori')->get();

        return view('product.create', compact('kategori'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_product' => 'required|string|max:255',
            'kategori' => 'required|string|exists:kategori,kode_kategori',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'poto_product' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('poto_product')) {
            $imagePath = $request->file('poto_product')->store('products_img', 'public');
        }

             DB::connection('postgres')->table('product')->insert([
            'nama_product' => $request->nama_product,
            'kategori' => $request->kategori,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stock' => $request->stock,
            'poto_product' => $imagePath,
            ]);

        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $kategori = \DB::table('kategori')->get();
        return view('product.edit', compact('product', 'kategori'));
    }

    // Proses update produk
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|string|exists:kategori,kode_kategori',
            'nama_product' => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'poto_product' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Perbarui data produk
        $product->kategori = $request->kategori;
        $product->nama_product = $request->nama_product;
        $product->harga_beli = $request->harga_beli;
        $product->harga_jual = $request->harga_jual;
        $product->stock = $request->stock;

        // Jika ada gambar baru, hapus yang lama dan simpan yang baru
        if ($request->hasFile('poto_product')) {
            // Hapus gambar lama jika ada
            if ($product->poto_product) {
                Storage::disk('public')->delete($product->poto_product);
            }

            // Simpan gambar baru
            $product->poto_product = $request->file('poto_product')->store('products', 'public');
        }

        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->route('product')->with('success', 'Produk berhasil diperbarui!');
    }
    public function destroy($id)
    {
        // Ambil produk berdasarkan ID dari PostgreSQL
        $product = DB::connection('postgres')->table('product')->where('id', $id)->first();

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Hapus gambar jika ada
        if ($product->poto_product) {
            Storage::delete('public/' . $product->poto_product);
        }

        // Hapus produk dari database
        DB::connection('postgres')->table('product')->where('id', $id)->delete();

        return redirect()->route('product')->with('success', 'Produk berhasil dihapus.');
    }
    public function filter(Request $request)
    {
        $query = Product::query()->with('kategori');

        // Filter Berdasarkan Kategori
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Pencarian Berdasarkan Nama Produk
        if ($request->search) {
            $query->where('nama_product', 'LIKE', '%' . $request->search . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('poto_product', function ($product) {
                return $product->poto_product;
            })
            ->addColumn('nama_kategori', function ($product) {
                return $product->kategori->nama_kategori ?? '-';
            })
            ->addColumn('aksi', function ($product) {
                return '
                <a href="' . route('product_edit', $product->id) . '" class="text-primary me-2"><i class="fas fa-edit"></i></a>
                <form action="' . route('product_destroy', $product->id) . '" method="POST" class="d-inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-link text-danger" onclick="return confirm(\'Hapus produk ini?\')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


}
