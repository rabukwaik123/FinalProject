<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'cart_status',
        'customers_id',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class, 'cart_id');
    }

     protected static function booted()
    {
        static::deleting(function ($cart) {
            $cart->cartItems()->delete();
        });
    }
}
