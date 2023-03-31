<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\order;
use App\Http\Models\orderItem;
use App\Http\Models\Product;
use App\Http\Models\Variant;
use App\Http\Models\Inventory;
use Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCart(){
        $order = $this->getUserOder();
        $items = $order->getItems;

        $data = ['order' => $order, 'items' => $items];
        return view('cart', $data);
    }

    public function getUserOder(){
        $order = order::where('status', '0')->count();
        if($order== "0"):
            $order = new order;
            $order->user_id = Auth::id();
            $order->save();
        else:
            $order = order::where('status', '0')->first();
        endif;
        return $order;
    }

    public function postCartAdd(Request $request, $id){
        if(is_null($request->input('inventory'))):
            return back()->with('message','Seleccione una opción del producto')->with('typealert','danger');
        else:
        $inventory = Inventory::where('id', $request->input('inventory'))->count();
        if($inventory == "0"):
            return back()->with('message','La opción seleccionada no esta disponible')->with('typealert','danger');
        else:
            $inventory = Inventory::find($request->input('inventory'));
        if($inventory->product_id != $id):
            return back()->with('message','No se puede agregar este producto al carrito')->with('typealert','danger');
        else:
        $order = $this->getUserOder();
        $product = Product::find($id);
        $inventory = Inventory::find($request->input('inventory'));

        if($request->input('quantity')< 1):
            return back()->with('message','Es necesario ingresar la cantidad de productos')->with('typealert','danger');
        else:
            $oitem = new orderItem;
            $total = $product->price * $request->input('quantity');
            if($request->input('variant')):
            $variant = Variant::find($request->input('variant'));
            $variant_label = ' / '.$variant->name;
            else:
            $variant_label = '';
            endif;
            $label = $product->name.' / '.$inventory->name.$variant_label;
            $oitem->user_id = Auth::id();
            $oitem->order_id = $order->id;
            $oitem->product_id = $id;
            $oitem->inventory_id = $request->input('inventory');
            $oitem->variant_id = $request->input('variant');
            $oitem->label_item = $label;
            $oitem->quantity = $request->input('quantity');
            $oitem->discount_status = $request->in_discount;
            $oitem->discount = $request->discount;
            $oitem->price_unit = $product->price;
            $oitem->total = $total;

            if($oitem->save()):  
                return back()->with('message','Producto agregado al carrito de compras con éxito.')->with('typealert','success');
            endif;
        endif;
    endif;
endif;endif;
    }
}
