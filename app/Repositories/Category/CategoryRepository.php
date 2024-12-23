<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function index()
    {
        return Category::get();
    }
    public function store($validatedData)
    {
        return  Category::create($validatedData);
    }
    public function show($id)
    {
        return Category::find($id);
    }
    public function update()
    {

        return;
    }
}
