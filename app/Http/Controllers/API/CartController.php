<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        return Cart::all();
    }

    public function store(Request $request)
    {
        return Cart::create($request->all());
    }

    public function show($id)
    {
        return Cart::with('items')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return $cart;
    }

    public function destroy($id)
    {
        return Cart::destroy($id);
    }
}