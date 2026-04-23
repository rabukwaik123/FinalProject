<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory,SoftDeletes ;

    protected $touches = ['cart'];

    protected $fillable = [
        'quantity',
        'total_price',
        'cart_id',
        'product_id',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    protected static function booted()
    {
        // Soft delete → soft delete the cart items
        static::deleting(function ($cart) {
            if (!$cart->isForceDeleting()) {
                $cart->cartItems()->delete(); // soft delete
            }
        });

        // Force delete → permanently delete the cart items
        static::forceDeleting(function ($cart) {
            $cart->cartItems()->forceDelete(); // permanent delete
        });

        // Restore → restore the cart items too
        static::restoring(function ($cart) {
            $cart->cartItems()->withTrashed()->restore(); //  restore items too
        });
    }
}

