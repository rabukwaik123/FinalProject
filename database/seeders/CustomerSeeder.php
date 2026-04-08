<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['email' => 'user1@gmail.com', 'password' => '123456'],
            ['email' => 'user2@gmail.com', 'password' => '123456'],
            ['email' => 'user3@gmail.com', 'password' => '123456'],
            ['email' => 'user4@gmail.com', 'password' => '123456'],
            ['email' => 'user5@gmail.com', 'password' => '123456'],
        ];

        foreach ($customers as $customer) {
            Customer::create([
                'email' => $customer['email'],
                'password' => Hash::make($customer['password']),
            ]);
        }
    }
}
