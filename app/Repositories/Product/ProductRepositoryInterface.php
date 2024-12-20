<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function index();
    public function store($validatedData);
    public function show($id);
}
