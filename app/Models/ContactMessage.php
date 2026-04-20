<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /** @use HasFactory<\Database\Factories\ContactMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'message_text',
    ];


    public function brands(){
        return $this->belongsToMany(Brand::class , 'brand_contact_messages', 'contact_message_id', 'brand_id');
    }

}
