<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $message1 = ContactMessage::create([
            'sender_name' => 'Ruba kwaik',
            'sender_email' => 'ruba@example.com',
            'message_text' => 'I want to know more about your products'
        ]);
        $message1->brands()->attach([1 , 2 , 3 , 4]);

        $message2 = ContactMessage::create([
            'sender_name' => 'Doaa Kwaik',
            'sender_email' => 'doaa@example.com',
            'message_text' => 'Do you have offers on skincare?',
        ]);
        $message2->brands()->attach([2]);

        $message3 = ContactMessage::create([
            'sender_name' => 'Sara Alsalout',
            'sender_email' => 'sara@example.com',
            'message_text' => 'I need help choosing a product',
        ]);

    }
}

