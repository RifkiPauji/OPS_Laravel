<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * Ambil data dari model Product untuk diekspor.
     */
    public function collection()
    {
        return Product::select('id', 'nama_product', 'kategori', 'harga_beli', 'harga_jual', 'stock')->get();
    }

    /**
     * Tambahkan header untuk setiap kolom di Excel.
     */
    public function headings(): array
    {
        return ['ID', 'Nama Produk', 'Kategori Produk', 'Harga Beli', 'Harga Jual', 'Stok'];
    }
}
