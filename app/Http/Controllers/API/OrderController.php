<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return response()->json($orders);
    }

    public function updateEstado($id, Request $request)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,En Proceso,Entregado'
        ]);

        $order = Order::findOrFail($id);
        $order->estado = $request->estado;
        $order->save();

        return response()->json(['message' => 'Estado actualizado']);
    }
    public function verificarPago($id)
    {
        $order = Order::findOrFail($id);
        $order->transaccion_id = uniqid('trx_'); // simula un código de transacción
        $order->save();

        return response()->json(['message' => 'Pago verificado']);
    }
    public function store(Request $request)
    {
        // Validar datos de la orden (modifica según tus campos)
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'productos' => 'required|array',
            'total' => 'required|numeric',
            'metodo_pago' => 'required|string',
            'forma_entrega' => 'required|string',
            // etc, según tu tabla orders
        ]);

        $order = Order::create($validated);

        return response()->json([
            'message' => 'Orden creada correctamente',
            'order' => $order
        ], 201);
    }
}
