<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function index();
    public function store($validatedData);
    public function show($id);
    public function update();
}
