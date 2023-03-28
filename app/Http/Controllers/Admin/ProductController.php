<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator, Str, Config, Image;

use App\Http\Models\Category;
use App\Http\Models\PGallery;
use App\Http\Models\Product;
use App\Http\Models\Inventory;
use App\Http\Models\Variant;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status){
        switch($status){
            case '0':
                $products = Product::with(['cat', 'getSubCategory', 'getPrice'])->where('status', '0')->orderBy('id','Desc')->paginate(25);
                break;
            case '1':
                $products = Product::with(['cat', 'getSubCategory', 'getPrice'])->where('status', '1')->orderBy('id','Desc')->paginate(25);
                break;
            case 'all':
                $products = Product::with(['cat', 'getSubCategory', 'getPrice'])->orderBy('id','Desc')->paginate(25);
                break;
            case 'trash':
                $products = Product::with(['cat', 'getSubCategory', 'getPrice'])->onlyTrashed()->orderBy('id','Desc')->paginate(25);
                break;

        }
        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    public function getProductAdd(){
        $cats = Category::where('module', '0')->where('parent', '0') ->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'img.required' => 'Seleccione una imagen destacada',
            'img.image' => 'El archivo no es una imagen',
            'content.required' => 'Ingrese una descripción del producto'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            
            $filename= rand(1,999). '-'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;
            
            $product = new Product;
            $product-> status = '0';
            $product->code = e($request->input('code'));
            $product->name= e($request->input('name'));
            $product->slug= Str::slug($request->input('name'));
            $product->category_id=$request->input('category');
            $product->subcategory_id=$request->input('subcategory');
            $product->file_path = date('Y-m-d');
            $product->image=$filename;
            $product->in_discount= $request->input('indiscount');
            $product->discount= $request->input('discount');
            $product->status = $request->input('status');
            $product->content= e($request->input('content'));
            
            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path,$filename,'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                return redirect('/admin/product/add')->with('message','Guardado con éxito.')->with('typealert','success');
            endif;
        endif;

    }

    public function getProductEdit($id){
        $p = Product::findOrFail($id);
        $cats = Category::where('module', '0')->where('parent', '0') ->pluck('name', 'id');
        $data = ['cats' => $cats, 'p'=> $p];
        return view('admin.products.edit', $data);
    }
    public function postProductEdit($id, Request $request){
        $rules = [
            'name' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'img.image' => 'El archivo no es una imagen',
            'content.required' => 'Ingrese una descripción del producto'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $product =  Product::findOrFail($id);
            $ipp = $product->file_path;
            $ip = $product->image;
            $product-> status = $request->input('status');
            $product->code = e($request->input('code'));
            $product->name= e($request->input('name'));
            $product->category_id=$request->input('category');
            $product->subcategory_id=$request->input('subcategory');
            if($request->hasFile('img')):
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename= rand(1,999). '-'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;
            $product->file_path = date('Y-m-d');
            $product->image=$filename;
            endif;
            $product->in_discount= $request->input('indiscount');
            $product->discount= $request->input('discount');
            $product->content= e($request->input('content'));
            if($product->save()):
                $this->getUpdateMinPrice($product->id);
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path,$filename,'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                return back()->with('message','Actualizado con éxito.')->with('typealert','success');
            endif;
        endif;
    }

    public  function postProductGalleryAdd($id, Request $request){
        $rules = [
            'file_image' => 'required'
        ];

        $messages = [
            'file_image.required' => 'Seleccione una imagen.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            if($request->hasFile('file_image')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));
                $filename= rand(1,999). '-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $g = new PGallery();
                $g->product_id = $id;
                $g ->file_path = date('Y-m-d');
                $g->file_name = $filename;

                if($g->save()):
                    if($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path,$filename,'uploads');
                        $img = Image::make($file_file);
                        $img->fit(512, 512, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return back()->with('message','Imagen subida con éxito.')->with('typealert','success');
                endif;
                endif;
        endif;
    }

   function getProductGalleryDelete($id, $gid){
    $g = PGallery::findOrFail($gid);
    $path = $g->file_path;
    $file = $g->file_name;
    $upload_path = Config::get('filesystems.disks.uploads.root');
    if($g->product_id != $id){
        return back()->with('message','La imagen no se puede eliminar.')->with('typealert','danger');
    }else{
        if($g->delete()):
            unlink($upload_path.'/'.$path.'/'.$file);
            unlink($upload_path.'/'.$path.'/t_'.$file);
            return back()->with('message','Imagen borrada con éxito.')->with('typealert','success');
        endif;
    }
    }

    public function postProductSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El campo consulta es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('admin/products/1')->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            switch ($request->input('filter')): 
                case '0':
                    $products = Product::with(['cat'])->where('name', 'LIKE', '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id','Desc')->get();
                    break;
                case '1':
                    $products = Product::with(['cat'])->where('code',$request->input('search'))->orderBy('id','Desc')->get();
                    break;
                    
                endswitch;

            $data = ['products' => $products];
            return view('admin.products.search', $data);
        endif;
    }

    public function getProductDelete($id){
        $p = Product::findOrFail($id);
        if($p->delete()):
            return back()->with('message','Producto enviado a la papelera de reciclaje.')->with('typealert','success');
        endif;
    }

    public function getProductRestore($id){
        $p = Product::onlyTrashed()->where('id', $id)->first();
        if($p->restore()):
            return redirect('/admin/product/'.$p->id.'/edit')->with('message','Este producto se restauró con éxito.')->with('typealert','success');
        endif;
    }


    public function getProductInventory($id){
        $product = Product::findOrFail($id);
        $data = ['product' => $product];
        return view('admin.products.inventory', $data);
    }

    public function postProductInventory(Request $request, $id){
        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del inventario es requerido',
            'price.required' => 'Ingrese el precio del inventario',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $inventory = new Inventory;
            $inventory->product_id = $id;
            $inventory->name = e($request->input('name'));
            $inventory->quantity = $request->input('inventory');
            $inventory->price = $request->input('price');
            $inventory->limited = $request->input('limited');
            $inventory->minimum = $request->input('minimum');
            if($inventory->save()):
                $this->getUpdateMinPrice($inventory->product_id);
                return back()->with('message','Guardado con éxito.')->with('typealert','success');
            endif;
        endif;
    }

    public function getProductInventoryEdit($id){
        $inventory = Inventory::findOrFail($id);
        $data = ['inventory' => $inventory];
        return view('admin.products.inventory_edit', $data);
    }

    public function postProductInventoryEdit($id, Request $request){
        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del inventario es requerido',
            'price.required' => 'Ingrese el precio del inventario',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $inventory =  Inventory::find($id);
            $inventory->name = e($request->input('name'));
            $inventory->quantity = $request->input('inventory');
            $inventory->price = $request->input('price');
            $inventory->limited = $request->input('limited');
            $inventory->minimum = $request->input('minimum');
            if($inventory->save()):
                $this->getUpdateMinPrice($inventory->product_id);
                return back()->with('message','Guardado con éxito.')->with('typealert','success');
            endif;
        endif;
    }

    public function getProductInventoryDelete($id){
        $inventory = Inventory::findOrFail($id);
        if($inventory->delete()):
            $this->getUpdateMinPrice($inventory->product_id);
            return back()->with('message','Inventario eliminado.')->with('typealert','success');
        endif;
    }

    public function postProductInventoryVariantAdd($id, Request $request){
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre de la variante es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $inventory = Inventory::findOrFail($id);

            $variant = new Variant;
            $variant->product_id= $inventory->product_id;
            $variant->inventory_id= $id;
            $variant->name = e($request->input('name'));
            if($variant->save()):
                return back()->with('message','Guardado con éxito.')->with('typealert','success');
            endif;
        endif;
    }

    public function getProductInventoryVariantDelete($id){
        $variant = Variant::findOrFail($id);
        if($variant->delete()):
            return back()->with('message','Variante eliminada.')->with('typealert','success');
        endif;
    }

    public function getUpdateMinPrice($id){
        $product = Product::find($id);
        $price = $product->getPrice->min('price');

        $product->price = $price;
        $product->save();
    }
}
