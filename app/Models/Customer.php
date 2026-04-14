<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'email',
        'password',
    ];

    public function carts(){
        return $this->hasMany(Cart::class, 'customers_id');
    }

     public function user(){
        return $this->morphOne(User::class,'actor', 'actor_type', 'actor_id', 'id');
    }
   protected static function booted()
    {
        // Soft delete → soft delete the user
        static::deleting(function ($customer) {
            if (!$customer->isForceDeleting()) {
                $customer->user()->delete(); // soft delete
            }
        });

        // Force delete → permanently delete the user
        static::forceDeleting(function ($customer) {
            $customer->user()->forceDelete(); // permanent delete
        });
    }
}
