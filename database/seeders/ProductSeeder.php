<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Python CS Handbook',
                'slug' => 'python-cs-handbook',
                'price' => 15.00,
                'description' => 'Study handbook for Python and computer science basics.',
            ],
            [
                'name' => 'Networking Essentials',
                'slug' => 'networking-essentials',
                'price' => 20.00,
                'description' => 'Core networking concepts and practice materials.',
            ],
            [
                'name' => 'USB Drive (64GB)',
                'slug' => 'usb-drive-64gb',
                'price' => 25.00,
                'description' => 'Portable storage for course materials.',
            ],
            [
                'name' => 'Computers',
                'slug' => 'computers',
                'price' => 30.00,
                'description' => 'Introductory computing study kit / materials.',
            ],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                [...$product, 'is_active' => true],
            );
        }
    }
}
