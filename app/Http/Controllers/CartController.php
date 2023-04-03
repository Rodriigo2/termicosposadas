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

            if($inventory->limited=="0"):
                if($request->input('quantity') > $inventory->quantity):
                    return back()->with('message','Hay un problema: ingresó más productos de los que tenemos en inventario. Por favor revise y ajuste la cantidad. Gracias.')->with('typealert','danger');
                endif;
            endif;

            if(count(collect($inventory->getVariants)) > "0"):
                if(is_null($request->input('variant'))):
                    return back()->with('message','Seleccione todas las opciones del producto.')->with('typealert','danger');
                endif;
            endif;

            if(!is_null($request->input('variant'))):
            $variant = Variant::where('id', $request->input('variant'))->count();
            if($variant == "0"):
                return back()->with('message','Selección no encontrada.')->with('typealert','danger');
            else:
                $variant = Variant::find($request->input('variant'));
                if($variant->inventory_id != $inventory->id):
                return back()->with('message','Selección no válida.')->with('typealert','danger');
            endif;
            endif;
        endif;

            $query = orderItem::where('order_id' , $order->id)->where('product_id', $product->id)->count();
            if($query == 0):
            $oitem = new orderItem;
            $price = $this->getCalculatePrice($product->in_discount, $product->discount, $inventory->price);
            $total = $price * $request->input('quantity');
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
            $oitem->discount_status = $product->in_discount;
            $oitem->discount = $product->discount;
            $oitem->discount_until_date = $product->discount_until_date;
            $oitem->price_initial = $inventory->price;
            $oitem->price_unit = $price;
            $oitem->total = $total;
            if($oitem->save()):  
                return back()->with('message','Producto agregado al carrito de compras con éxito.')->with('typealert','success');
                    endif;
                else:
                    return back()->with('message','Este producto ya se encuentra en su carrito de compras.')->with('typealert','danger');
                endif;
                endif;
            endif;
        endif;
    endif;    
}

public function postCartItemQuantityUpdate($id, Request $request ){
    $order = $this->getUserOder();
    $oitem = orderItem::find($id);
    $inventory = Inventory::find($oitem->inventory_id);
    //$product = Product::find($oitem->product_id);
    if($order->id != $oitem->order_id):
        return back()->with('message','No podemos actualizar la cantidad de este item.')->with('typealert','danger');
    else: 
        if($inventory->limited == "0"):
            if($request->input('quantity')>$inventory->quantity ):
                return back()->with('message','La cantidad ingresada supera al inventario.')->with('typealert','danger');
            endif;
        endif;
        $total = $oitem->price_unit * $request->input('quantity');
        $oitem->quantity = $request->input('quantity');
        $oitem->total = $total;
        if($oitem->save()):  
            return back()->with('message','Cantidad actualizada con éxito.')->with('typealert','success');
                endif;
    endif;
}

    public function getCartItemDelete($id){
        $oitem = orderItem::find($id);
        if($oitem->delete()):  
            return back()->with('message','Producto eliminado del carrito con éxito.')->with('typealert','success');
                endif;
    }

    public function getCalculatePrice($in_discount, $discount, $price){
        $final_price = $price;
        if($in_discount == "1"):
        $discount_value = '0.'.$discount;
        $discount_calc = $price * $discount_value;
        $final_price = $price - $discount_calc;
        endif;
        return $final_price;
    }

}
