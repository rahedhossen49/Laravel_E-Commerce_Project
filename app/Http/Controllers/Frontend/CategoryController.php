<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function archiveProducts($slug)
{
    $category = Category::select('id', 'title')
        ->where('slug', $slug)
        ->firstOrFail();
    $products = Product::with(['galleries' => function($query) {
        return $query->select('id', 'product_id', 'image')->first();
    }])
    ->whereHas('categories', function($query) use ($category) {
        $query->where('categories.id', $category->id);
    })
    ->select('id', 'title', 'slug', 'image', 'price', 'selling_price')
    ->with('featuredgallery')
    ->latest()
    ->get();

    return view('Frontend.Category_Archive', compact('products', 'category'));
}



}
