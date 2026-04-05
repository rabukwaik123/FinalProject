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
}
