<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cardholder_name', 'card_number_encrypted',
        'expiration_month', 'expiration_year', 'card_type', 'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
