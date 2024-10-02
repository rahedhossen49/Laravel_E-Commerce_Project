<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function archiveProducts($slug){

        $products = Product::whereHas('categories',function($query) use ($slug){

            $query->where('slug',$slug);
        })->select('id','title','slug','image','price','selling_price')->with('featuredgallery')->latest()->get();

        return view('Frontend.Category_Archive',compact('products'));
    }
}
