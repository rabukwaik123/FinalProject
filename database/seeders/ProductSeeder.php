<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'product_name' => 'Product ' . $i,
                'product_description' => 'Description for product ' . $i,
                'price' => rand(10, 200),
                'category_id' => $categories[array_rand($categories)],
                'brand_id' => $brands[array_rand($brands)],
                'is_active' => rand(0,1),
                'image_path' => null, // or fake path
            ]);
    }
}
}
