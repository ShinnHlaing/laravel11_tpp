<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        // dd($categories);
        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show', compact('category'));
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        // dd($category);
        return redirect()->route('categories.index');
    }
}
