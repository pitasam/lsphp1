<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::all();
        $data['cats'] = $cats;
        return view('categories.listcategories', $data);
    }
    public function categories()
    {

    }
}
