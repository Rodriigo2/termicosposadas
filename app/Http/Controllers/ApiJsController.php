<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App\Http\Models\Product;

class ApiJsController extends Controller
{
    function getProductsSection($section, Request $request){
        $items_x_page = Config::get('termicosposadas.products_per_page');
        switch ($section) :
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page);
                break;
            
            default:
            $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page);
                break;
            endswitch;

            return $products;
    }
}
