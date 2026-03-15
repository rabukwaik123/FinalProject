<?php

namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::updateOrCreate(['brand_name' => 'Rimmel London']);
        Brand::updateOrCreate(['brand_name' => 'NOTE']);
        Brand::updateOrCreate(['brand_name' => 'Petite Maison']);
        Brand::updateOrCreate(['brand_name' => 'Topface']);
    }
}
