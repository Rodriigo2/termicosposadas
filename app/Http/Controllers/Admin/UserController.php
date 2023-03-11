<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getUsers($status){
        if($status == 'all'):
        $users = User::orderBy('id','Desc')->paginate(30);
        else:
            $users = User::where('status', $status)->orderBy('id','Desc')->paginate(30);
        endif;
        $data = ['users' => $users];
        return view('admin.users.home', $data);
    }

    public function getUserEdit($id){
        $u = User::findorFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_edit', $data);
    }

    public function getUserBanned($id){
        $u = User::findorFail($id);
        if($u->status == "100"):
            $u->status = "0";
            $msg = "Usuario activo nuevamente";
        else:
            $u->status = "100";
            $msg = "Usuario suspendido con éxito.";
        endif;

        if($u->save()):
            return back()->with('message',$msg)->with('typealert','success');
        endif;

    }

    public function getUserPermissions($id){
        $u = User::findorFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_permissions', $data);
    }

    public function postUserPermissions(Request $request, $id){
        $u = User::findorFail($id);
        $permissions = [
            'dashboard' => $request->input('dashboard'),
            'products' => $request->input('products'),
            'products_add' => $request->input('products_add'),
            'products_edit' => $request->input('products_edit'),
            'products_delete' => $request->input('products_delete'),
            'product_gallery_add' => $request->input('product_gallery_add'),
            'product_gallery_delete' => $request->input('product_gallery_delete'),
            'categories' => $request->input('categories'),
            'category_add' => $request->input('category_add'),
            'category_edit' => $request->input('category_edit'),
            'category_delete' => $request->input('category_delete'),
            'user_list' => $request->input('user_list'),
            'user_edit' => $request->input('user_edit'),
            'user_banned' => $request->input('user_banned'),
            'user_permissions' => $request->input('user_permissions')
        ];

        $permissions = json_encode($permissions);
        $u->permissions = $permissions;
        if($u->save()):
            return back()->with('message','Los permisos de tu usuario fueron actualizados con éxito')->with('typealert','success');
        endif;
    }
}
