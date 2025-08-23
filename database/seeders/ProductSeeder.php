<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['name' => 'Wireless Mouse', 'description' => 'A comfortable, ergonomic wireless mouse.', 'price' => 25.50]);
        Product::create(['name' => 'Mechanical Keyboard', 'description' => 'A backlit mechanical keyboard for typing and gaming.', 'price' => 89.99]);
        Product::create(['name' => '4K Monitor', 'description' => 'A 27-inch 4K UHD monitor with stunning visuals.', 'price' => 349.00]);
    }
}
