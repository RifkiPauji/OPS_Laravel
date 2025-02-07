<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\kategori\kategori;

class Product extends Model
{
    use HasFactory;
    protected $connection = 'postgres';
    protected $table = 'product';

    protected $fillable = [
        'kategori',
        'nama_product',
        'harga_beli',
        'harga_jual',
        'stock',
        'poto_product',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'kode_kategori');
    }
}

