<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
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
        $validatedData = $request->validated();
        $data['name'] = $request->name; //validated or validate
        $data['status'] = $request->has('status') ? true : false;
        if ($request->hasFile('image')) {
            // $image = $request->file('image');
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

    public function update(CategoryUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $category = Category::find($id);
        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('categoryImages'), $imageName);
            $category->image = $imageName;
        }
        $category->status = $request->has('status') ? 1 : 0;
        $category->update();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
