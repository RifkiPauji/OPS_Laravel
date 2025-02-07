<?php

namespace App\Models\kategori;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $connection = 'postgres';

    protected $table = 'kategori';

    protected $fillable = ['kode_kategori', 'nama_kategori'];

    public $timestamps = false;
}
