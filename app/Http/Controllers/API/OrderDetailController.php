<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'metodo_pago' => 'required|string',
            'forma_entrega' => 'required|string',
            'direccion' => 'nullable|string|max:255',
        ]);

        $order = Order::create([
            'user_id' => $request->user_id,
            'total' => $request->total,
            'metodo_pago' => $request->metodo_pago,
            'forma_entrega' => $request->forma_entrega,
            'estado' => 'Pendiente',
            'direccion' => $request->direccion ?? null,
        ]);

        return response()->json($order, 201);
    }


    public function index()
    {
        return OrderDetail::with('user')->latest()->get();
    }

    public function show($id)
    {
        $order = OrderDetail::findOrFail($id);
        return response()->json($order);
    }

    public function updateEstado($id, Request $request)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,En Proceso,Entregado',
        ]);

        $order = OrderDetail::findOrFail($id);
        $order->estado = $request->estado;
        $order->save();

        return response()->json(['message' => 'Estado actualizado']);
    }
}
