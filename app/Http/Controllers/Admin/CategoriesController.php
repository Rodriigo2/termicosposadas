<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator, Str;

use App\Http\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }

    public function getHome($module){
        $cats = Category::where('module', $module)->orderBy('name', 'Asc')->get();
        $data = ['cats' => $cats];
        return view('admin.categories.home', $data);
    }

    public function postCategoryAdd( Request $request){
        $rules = [
            'name' => 'required',
            'icon' => 'required',
        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría.',
            'icon.required' => 'Se requiere de un icono para la categoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');
        else:
            $c = new Category;
            $c ->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c->save()):
                return back()->with('message','Guardado con éxito.')->with('typealert','success');
            endif;
        endif;

    }

    public function getCategoryEdit($id){
        $cat = Category::findOrFail($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit( Request $request, $id){
        $rules = [
            'name' => 'required',
            'icon' => 'required',
        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría.',
            'icon.required' => 'Se requiere de un icono para la categoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');
        else:
            $c =  Category::findOrFail($id);
            $c ->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c->save()):
                return back()->with('message','Guardado con éxito.')->with('typealert','success');
            endif;
        endif;

    }

    public function getCategoryDelete($id){
        $c =  Category::findOrFail($id);
        if($c->delete()):
            return back()->with('message','Borrado con éxito.')->with('typealert','success');
        endif;
    }
}
