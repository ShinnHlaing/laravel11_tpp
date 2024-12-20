<?php

namespace App\Repositories\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function index()
    {
        return Product::all();
    }
    public function store($validatedData)
    {
        return Product::create($validatedData);
    }
    public function show($id)
    {
        return Product::find($id);
    }
}
