<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
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

    public function store(CategoryRequest $request)
    {
        $data = $request->validate();
        $data['status'] = $request->has('status') ? true : false;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('categoryImages'), $ImageName);
            $data = array_merge($data, ['image' => $ImageName]);
        }
        Category::create($data);
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->update([
            'name' => $request->name
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        // dd($category);
        return redirect()->route('categories.index');
    }
}
