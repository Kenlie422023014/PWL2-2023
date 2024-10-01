<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
/**
 * 
 * @return void
 */

class ProductController extends Controller
{
    public function index() : View
    {
    //get all products
    //$products = Product::select("products.*", "category_product.product_category_name as product_category_name")
    //                    ->join('category_product', 'category_product.id', '=', 'products.product_category_id')
    //                    ->latest()
    //                    ->paginate(10);
    
    $product = new Product;
    $products = $product->get_product()->latest()->paginate(10);

    //render view with products
    return view('products.index', compact('products'));

    }

    /** create
     *
     * @return view
     */
    public function create(): View
    {
        $product= new Product;
        $supplier= new Supplier;
        $data['categories']= $product->get_category_product()->get();
        $data['suppliers_']= $supplier->get_supplier()->get();
        return view('products.create',compact('data'));
    }
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $validatedData = $request->validate([
            'image'                 =>  'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'                 =>  'required|min:5',
            'product_category_id'   =>  'required|integer',
            'id_supplier'           =>  'required|integer',
            'description'           =>  'required|numeric',
            'stock'                 =>  'required|numeric'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images');
            //create product
            product::create([
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
            ]);
            return  redirect()->route('products.index')->with(['success' => 'data berhasil disimpan']);
        }
        return redirect()->route('products.index')->with(['error' => 'failed to upload image.']);
    }
}

