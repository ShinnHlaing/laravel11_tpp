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
        $products = [
            [
                "id" => 1,
                "name" => "Sony Xperia XI",
                "description" => "Smart Phone",
                "price" => 1399,
                "category_id" => 1,
            ],
            [
                "id" => 2,
                "name" => "MacBook Pro M2",
                "description" => "High-performance laptop with stunning Retina display",
                "price" => 1999,
                "category_id" => 1,
            ],
            [
                "id" => 3,
                "name" => "AirPods Pro (2nd Gen)",
                "description" => "Noise-canceling earbuds",
                "price" => 199,
                "category_id" => 2,
            ],
            [
                "id" => 4,
                "name" => "Apple Watch Series 8",
                "description" => "Advanced health and fitness smartwatch",
                "price" => 499,
                "category_id" => 2,
            ],
            [
                "id" => 5,
                "name" => "iPad Air (5th Gen)",
                "description" => "Powerful tablet with M1 chip and Liquid Retina display.",
                "price" => 599,
                "category_id" => 3,
            ],
            [
                "id" => 6,
                "name" => "HomePod mini",
                "description" => "Compact smart speaker with Siri voice control and rich sound.",
                "price" => 1299,
                "category_id" => 3,
            ],
            [
                "id" => 7,
                "name" => "Apple TV 4K (2nd Gen)",
                "description" => "Streaming device with 4K HDR and Dolby Atmos support.",
                "price" => 1299,
                "category_id" => 4,
            ],
            [
                "id" => 8,
                "name" => "MagSafe Battery Pack",
                "description" => "Portable battery pack for iPhone with magnetic attachment.",
                "price" => 1399,
                "category_id" => 4,
            ],
            [
                "id" => 9,
                "name" => "iPhone 15 Pro Max",
                "description" => "Latest flagship smartphone with powerful A17 Bionic chip",
                "price" => 1599,
                "category_id" => 5,
            ],
            [
                "id" => 10,
                "name" => "iPhone 14",
                "description" => "Powerful smartphone with A15 Bionic chip",
                "price" => 1199,
                "category_id" => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
