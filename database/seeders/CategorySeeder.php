<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "id" => 1,
                "name" => "IT"
            ],
            [
                "id" => 2,
                "name" => "Engineering"
            ],
            [
                "id" => 3,
                "name" => "Food"
            ],
            [
                "id" => 4,
                "name" => "Travel"
            ],
            [
                "id" => 5,
                "name" => "Education"
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category); //take data
        };
    }
}
