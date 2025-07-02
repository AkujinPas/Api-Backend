<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'metodo_pago',
        'forma_entrega',
        'estado',
        'transaccion_id',
        'direccion'
    ];

    // Relación con el usuario que hace la orden
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los detalles de la orden (OrderDetail)
    public function detalles()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
