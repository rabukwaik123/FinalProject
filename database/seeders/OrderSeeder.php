<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
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

        if (empty($customers)) {
            $this->command->info('Please seed customers first!');
            return;
        }

        $statuses = ['pending', 'completed', 'cancelled'];

        for ($i = 0; $i < 20; $i++) {
            Order::updateOrCreate([
                'order_status' => $statuses[array_rand($statuses)],
                'total_amount' => rand(50, 500), // random total
                'customer_id' => $customers[array_rand($customers)],
            ]);
        }
    }
}
