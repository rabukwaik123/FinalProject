<?php

namespace Database\Seeders;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
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
        $products = Product::all();
        
        for ($i = 1; $i <= 10; $i++) {
            $cart = Cart::create([
                'customer_id' => $customers[array_rand($customers)],
                'cart_status' => collect(['active', 'ordered', 'cancelled'])->random(),
            ]);

            $selectedProducts = $products->random(min(rand(1, 3), $products->count()));

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 4);

                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'total_price' => $product->price * $quantity,
                ]);
            }
        }
    }
}

