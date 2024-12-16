<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
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

        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }
}
