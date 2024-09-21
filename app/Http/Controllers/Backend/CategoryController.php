<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    function index(){
        $categories = Category::latest()->paginate(4);
        return view('backend.category.index',compact('categories'));
    }

    function store(Request $request){
        //* validaton
        $request->validate([
            'title' => 'required|unique:categories,title',
            'category_icon' => 'nullable|mimes:web,png,jpg,jpeg|max:200'
        ]);
        if($request->category_icon){

            $iconName = str($request->title)->slug(). '.' .$request->category_icon->extension();
            $upload = $request->category_icon->storeAs('category',$iconName,'public');
        }

        //* store
        $category = new Category();
        $category->title = $request->title;
        $category->slug = str($request->title)->slug();
        $category->icon = $request->category_icon? $upload : $category->icon;
        $category->save();
        if ($category) {
           return back();
        }
    }

    function destroy($id){
       $category = Category::findOrFail($id);
       if ($category->icon && Storage::disk('public')->exists($category->icon)) {
        Storage::disk('public')->delete($category->icon);
       }
       $category->delete();
       return back();
    }


}
