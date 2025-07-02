<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Relación al usuario que hace la orden
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Total de la orden
            $table->decimal('total', 10, 2);

            // Método de pago: puedes ampliar los métodos que aceptes
            $table->enum('metodo_pago', ['tarjeta', 'tienda', 'efectivo'])->default('tarjeta');

            // Forma de entrega
            $table->enum('forma_entrega', ['domicilio', 'sucursal'])->default('domicilio');

            // Estado de la orden
            $table->enum('estado', ['Pendiente', 'En Proceso', 'Entregado'])->default('Pendiente');

            // Dirección de entrega
            $table->text('direccion')->nullable();

            // ID de transacción (opcional, para pagos online)
            $table->string('transaccion_id')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
