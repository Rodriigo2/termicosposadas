<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category;

class StoreController extends Controller
{
    public function getStore(){
        $categories = Category::where('module', '0')->where('parent' , '0')->orderBy('order', 'Asc')->get();
        $data = ['categories' => $categories];
        return view('store', $data);
    }
}
