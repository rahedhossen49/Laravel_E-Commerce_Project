<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function index()
    {
        $categories = Category::whereHas('products')->where('featured', true)->get();
        $products = Product::select('id', 'title', 'slug', 'short_detail', 'long_detail', 'additional_info', 'price', 'selling_price', 'sku', 'stock', 'image')->get();

        return view('Frontend.HomePage', compact('categories', 'products'));
    }
}
