<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->text('details');
            $table->unsignedInteger('stock'); // Cambiado a unsignedInteger
            $table->enum('category_type', ['Calzado', 'Accesorios', 'Ropa']);
            $table->enum('shoes_type', ['Zapatillas', 'Botas', 'Sandalias', 'Zapatos formales'])->nullable();
            $table->enum('accesories_type', ['Gorras', 'Bufandas', 'Bolsas', 'Lentes de sol', 'Relojes', 'Cinturones'])->nullable();
            $table->enum('fashion_type', ['Vestidos', 'Pantalones', 'Camisas', 'Faldas', 'Chaquetas'])->nullable();
            $table->enum('season', ['PRIMAVERA-VERANO', 'OTOÑO-INVIERNO'])->nullable();
            $table->enum('category_g', ['Hombres', 'Mujeres', 'Niños']);
            $table->text('mark');
            $table->text('model');
            $table->enum('size_shoes', ['22', '23', '24', '25', '26', '27'])->nullable();
            $table->enum('size_fashion', ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'Unitalla'])->nullable();
            $table->enum('color', ['Verde', 'Rojo', 'Negro','Azul', 'Amarillo', 'Blanco', 'Gris']);
            $table->longText('image_ini');
            $table->longText('image_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
