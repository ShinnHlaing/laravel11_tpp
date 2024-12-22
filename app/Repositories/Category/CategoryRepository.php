<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function index()
    {
        return Category::all();
    }
    public function store($validatedData)
    {
        return  Category::create($validatedData);
    }
    public function show($id)
    {
        return Category::find($id);
    }
}
