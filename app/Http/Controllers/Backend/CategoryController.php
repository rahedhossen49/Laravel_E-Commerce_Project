<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadMedia;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use UploadMedia;
    function index($id = null)
    {
        $categories = Category::with('subcategories')->where('category_id', null)->latest()->paginate(4);
        $editedCategory = $id ? Category::findOrFail($id) : null;
        return view('backend.category.index', compact('categories', 'editedCategory'));
    }

    function store(Request $request)
    {

        // dd($request->all());
        //* validaton
        $request->validate([
            'title' => 'required|unique:categories,title',
            'category_icon' => 'nullable|mimes:web,png,jpg,jpeg|max:200'
        ]);


        $upload = $this->UploadSingleMedia($request->category_icon, str($request->title)->slug(), 'category', 'category/android.png');
        //* store
        $category = new Category();
        $category->title = $request->title;
        $category->slug = str($request->title)->slug();
        $category->icon = $request->category_icon ? $upload : $category->icon;
        $category->category_id = $request->parentCategory ?? $category->category_id;
        $category->save();
        if ($category) {
            return back();
        }
    }

    function update(Request $request, $id) {}

    function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->icon && Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }
        $category->delete();
        return back();
    }
}
