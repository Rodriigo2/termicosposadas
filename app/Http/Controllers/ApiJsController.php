<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config, Auth;
use App\Http\Models\Product, App\Http\Models\Favorite, App\Http\Models\Inventory;

class ApiJsController extends Controller
{
    public function __construct(){
        $this ->middleware('auth')->except(['getProductsSection']);
    }
    function getProductsSection($section, Request $request){
        $items_x_page = Config::get('termicosposadas.products_per_page');
        $items_x_page_random = Config::get('termicosposadas.products_per_page_random');
        switch ($section) :
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page_random);
                break;
            case 'store':
                    $products = Product::where('status', 1)->orderBy('id', 'Desc')->paginate($items_x_page);
                    break;
            default:
            $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_page_random);
                break;
            endswitch;

            return $products;
    }

    function postFavoriteAdd($object, $module, Request $request){
        $query = Favorite::where('user_id', Auth::id())->where('module', $module)->where('object_id', $object)->count();
        if($query > 0):
            $data = ['status' => 'error', 'msg' => 'Este producto ya está en su lista de favoritos.'];
        else:
            $favorite = new Favorite;
        $favorite->user_id = Auth::id();
        $favorite->module = $module;
        $favorite->object_id = $object;
        if($favorite->save()):
            $data = ['status' => 'success', 'msg' => 'Agregado a la lista de favoritos.'];
        endif;
        endif;
        return response()->json($data);
    }

    public function postUserFavorites(Request $request){
        $objects = json_decode($request->input('objects'), true);
        $query = Favorite::where('user_id', Auth::id())
                ->where('module', $request->input('module'))
                ->whereIn('object_id', explode(",", $request->input('objects')))
                ->pluck('object_id');
                if(count(collect($query))> 0):
                    $data = ['status' => 'success', 'count' => count(collect($query)), 'objects' => $query];
                else:
                    $data = ['status' => 'success', 'count' => count(collect($query))];
                endif;

                return response()->json($data);

    }

    public function postProductInventoryVariants($id){
        $query = Inventory::find($id);
        return response()->json($query->getVariants);
    }

}
