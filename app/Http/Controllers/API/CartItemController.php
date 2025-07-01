<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CartItem::all();
    }

    public function store(Request $request)
    {
        return CartItem::create($request->all());
    }

    public function show($id)
    {
        return CartItem::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    public function destroy($id)
    {
        return CartItem::destroy($id);
    }
}