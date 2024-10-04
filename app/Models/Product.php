<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */

     protected $fillable = [
        'image',
        'title',
        'product_category_id',
        'supplier_id',
        'description',
        'price',
        'stock',
    ];

    public function get_product()
    {
     //get all product
     $sql = $this->select("products.*","category_product.product_category_name as product_category_name")
                 ->join('category_product','category_product.id','=','products.product_category_id');//
     return $sql;      
    }

    public function get_category_product()  {
        $sql = DB::table('category_product')->select('*');

        return $sql;
    }

}

