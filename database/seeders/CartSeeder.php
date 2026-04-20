<?php

namespace Database\Seeders;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            Cart::create([
                'customer_id' => $customers[array_rand($customers)],
                'cart_status' => collect(['active', 'ordered', 'cancelled'])->random(),
            ]);
        }
    }
}
