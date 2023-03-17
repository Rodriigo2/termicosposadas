<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category;

class ContentController extends Controller
{
    public function getHome(){
        $categories = Category::where('module', '0')->orderBy('name', 'Asc')->get();
        $data = ['categories' => $categories];
        return view('home', $data);
    }
}
