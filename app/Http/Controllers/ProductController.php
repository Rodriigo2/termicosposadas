<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct($id, $slug){
        $product = Product::findorFail($id);
        $data = ['product'=> $product];
        return view('product.product_single', $data);
    }
}
