<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $categories = Category::whereHas('products')->where('featured',true)->get();
        return view('Frontend.HomePage',compact('categories'));

    }
}
