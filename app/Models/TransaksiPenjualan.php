<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualan';

    protected $fillable = [
        'id_products',
        'jumlah_pembelian',
        'nama_kasir',
        'tanggal_transaksi'
    ];

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_products');
    }
}
