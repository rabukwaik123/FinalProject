<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
     protected $fillable = [
        'email',
        'password',
    ];

    public function user(){
        return $this->morphOne(User::class,'actor', 'actor_type', 'actor_id', 'id');
    }
      protected static function booted()
    {
        static::deleting(function ($admin) {
            $admin->user()->delete();
        });
    }
}
