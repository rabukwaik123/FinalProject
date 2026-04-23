<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $admins = Admin::pluck('id')->toArray();
        $images = [
            'cms/dist/img/product/product1.jpg',
            'cms/dist/img/product/product2.png',
            'cms/dist/img/product/product3.jpg',
            'cms/dist/img/product/product4.jpg',
            'cms/dist/img/product/product5.jpg',
            'cms/dist/img/product/product6.png',
        ];

        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'product_name' => 'Product ' . $i,
                'product_description' => 'Description for product ' . $i,
                'price' => rand(10, 200),
                'category_id' => $categories[array_rand($categories)],
                'brand_id' => $brands[array_rand($brands)],
                'admin_id' => $admins[array_rand($admins)],
                'is_active' => rand(0,1),
                'image_path' => $images[array_rand($images)]
                ]);
    }
}
}
