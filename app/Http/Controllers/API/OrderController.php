<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'detalles.product')->latest()->get();
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
        $order->transaccion_id = uniqid('trx_');
        $order->save();

        return response()->json(['message' => 'Pago verificado']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'productos' => 'required|array',
            'productos.*.product_id' => 'required|exists:products,id',
            'productos.*.quantity' => 'required|integer|min:1',
            'productos.*.price' => 'required|numeric|min:0',
            'total' => 'required|numeric',
            'metodo_pago' => 'required|string',
            'forma_entrega' => 'required|string',
            'direccion' => 'nullable|string',
        ]);

        $order = Order::create([
            'user_id' => $validated['user_id'],
            'total' => $validated['total'],
            'metodo_pago' => $validated['metodo_pago'],
            'forma_entrega' => $validated['forma_entrega'],
            'estado' => 'Pendiente',
            'direccion' => $validated['direccion'] ?? null,
        ]);

        foreach ($validated['productos'] as $producto) {
            $order->detalles()->create([
                'product_id' => $producto['product_id'],
                'quantity' => $producto['quantity'],
                'price' => $producto['price'],
            ]);
        }

        return response()->json([
            'message' => 'Orden creada correctamente con detalles',
            'order' => $order->load('detalles.product')
        ], 201);
    }

    // ✅ NUEVO: Obtener órdenes de un cliente específico
    public function obtenerOrdenesCliente($id)
    {
        $ordenes = Order::with(['detalles.product'])
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($ordenes);
    }
}
