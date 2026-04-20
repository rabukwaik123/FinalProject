<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate(
            ['category_name' => 'Hair'],
            ['image_path' => 'storage/images/category/hair.jpg']
        );

        Category::updateOrCreate(
            ['category_name' => 'Make up'],
            ['image_path' => 'storage/images/category/Makeup.jpg']
        );

        Category::updateOrCreate(
            ['category_name' => 'Skin care'],
            ['image_path' => 'storage/images/category/skincare.jpg']
        );
        // Category::factory(20)->create();
    }
}
