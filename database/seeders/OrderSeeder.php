<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::pluck('id')->toArray();
        $products = Product::all();

        for ($i = 1; $i <= 10; $i++) {
            $product = $products->random();
            $quantity = rand(1, 4);
            $total = $product->price * $quantity;

            $order = Order::create([
                'customer_id' => $customers[array_rand($customers)],
                'order_status' => collect(['pending', 'completed', 'cancelled'])->random(),
                'total_amount' => $total,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total_price' => $total,
            ]);
        }
    }
}
