<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

   
    protected $table = 'transaksi_penjualan';

   
    public function get_transaksi()
    {
        
        $sql = $this->select(
                "transaksi_penjualan.*", 
                "products.title as product_name", 
                "products.price as product_price", 
                "category_product.product_category_name as category_name"
            )
            ->join('products', 'products.id', '=', 'transaksi_penjualan.id_products')
            ->join('category_product', 'category_product.id', '=', 'products.product_category_id');
        
        return $sql;
    }
}
