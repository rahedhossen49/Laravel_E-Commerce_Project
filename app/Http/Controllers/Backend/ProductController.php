<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Traits\Trait\SlugGenarator;
use App\Traits\UploadMedia;

class ProductController extends Controller
{
    use UploadMedia, SlugGenarator;
    function index()
    {

        return view('backend.products.index');
    }


    function create()
    {
        $categories = Category::select('id', 'title')->get();
        return view('backend.products.create', compact('categories'));
    }

    function store(Request $request)
    {
        // * Validation


        $request->validate([
            'title' => 'required |min:3',
            'price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'integer',
            'image' => 'nullable|mimes:jpg,jpeg,png,web,svg',
            'gall_img.*' => 'nullable|mimes:jpg,jpeg,png,web,svg',
        ]);


        // * Check The DB

        $slug = $this->BuildSlug($request->title, Product::class);
        $gallImages = $this->MulltipleUploadMedia($request->gall_img, $slug);

        // * Store Porduct

        $product = new Product();
        $product->title = $request->title;
        $product->slug = $slug;
        $product->price = $request->price;
        $product->selling_price = $request->selling_price;
        $product->short_detail = $request->detail;
        $product->long_detail = $request->long_detail;
        $product->additional_info = $request->additional_info;
        $product->sku = $request->sku;
        $product->stock = $request->stock;
        if ($request->hasFile('image')) {
            $product->image = $this->UploadSingleMedia($request->image, $product->slug, 'product', '');
        }
        $product->save();

        // * Gallary Innsert

        if ($product) {
            foreach ($gallImages as  $gallImage) {
                $gall = new Gallery();
                $gall->product_id = $product->id;
                $gall->image = $gallImage;
                $gall->save();
            }

            $product->categories()->sync($request->categories);
        }

        return redirect()->route('product.index')->with('sucess', 'product create successfull');
    }


    function showProduct($slug)
    {

        $product = Product::with('reviews.customer', 'galleries', 'categories')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('reviews')->where('id', '!=', $product->id)
            ->whereHas('categories', function ($q) use ($product) {
                $q->where('slug', $product->categories()->first()->slug);
            })
            ->take(6)
            ->select('id', 'title', 'slug', 'image', 'price', 'selling_price')
            ->with('featuredGallery')->latest()->get();

        return view('Frontend.singleProduct', compact('product', 'relatedProducts'));
    }


    function ajaxSearch(Request $request)
    {

        $search = $request->input('search');

        $products = Product::where('title', 'like', "%$search%")
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->get();

        return response()->json($products);
    }



    public function contact()
    {


        return view('layouts.Contact');
    }



    public function about()
    {


        return view('layouts.about');
    }
}
