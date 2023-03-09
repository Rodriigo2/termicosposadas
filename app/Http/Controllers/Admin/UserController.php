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
        $this->middleware('isadmin');
    }

    public function getUsers(){
        $users = User::orderBy('id','Desc')->get();
        $data = ['users' => $users];
        return view('admin.users.home', $data);
    }
}
