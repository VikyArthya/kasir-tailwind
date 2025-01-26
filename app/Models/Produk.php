<?php

namespace App\Models;

use App\Imports\Produk as ImportsProduk;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $fillable = ['kode', 'nama', 'harga', 'stok'];
    public function detilTransaksi(){
        return $this->hasMany(Produk::class);
    }
}