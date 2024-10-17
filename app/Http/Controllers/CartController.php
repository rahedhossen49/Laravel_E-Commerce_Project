<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    function store(Request $request){
         dd($request->all());
    }
}
