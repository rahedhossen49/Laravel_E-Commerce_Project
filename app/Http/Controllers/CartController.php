<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        if (auth('customer')->check()) {
            $cart = new Cart();
            $cart->customer_id = auth('customer')->user()->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->qty;
            $cart->total_ammount = $request->qty * $request->product_price;
            $cart->save();

            return back()->with('success', 'Product added to cart');
        } else {
            return back()->with('error', 'You need to log in first');
        }
    }


}
