<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
      'name',
      'price',
      'description',
      'details',
      'stock',
      'category_type',  
      'shoes_type',
      'accesories_type',
      'fashion_type',
      'category_g',
      'mark',
      'season',
      'model',
      'size_shoes',
      'size_fashion',
      'color',
      'image_ini',
      'image_fin'    
    ];
     public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
