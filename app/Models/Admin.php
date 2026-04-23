<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory,SoftDeletes;
     protected $fillable = [
        'email',
        'password',
    ];


    public function products()
    {
        return $this->hasMany(Product::class, 'admin_id');
    }
    public function user(){
        return $this->morphOne(User::class,'actor', 'actor_type', 'actor_id', 'id');
    }

    protected static function booted()
    {
        // Soft delete → soft delete the user
        static::deleting(function ($admin) {
            if (!$admin->isForceDeleting()) {
                $admin->user()->delete(); // soft delete
            }
        });

        // Force delete → permanently delete the user
        static::forceDeleting(function ($admin) {
            $admin->user()->forceDelete(); // permanent delete
        });
    }
}
