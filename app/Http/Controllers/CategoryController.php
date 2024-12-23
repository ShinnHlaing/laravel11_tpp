<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->index();

        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->has('status') ? true : false;
        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            $ImageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('categoryImages'), $ImageName);
            $validatedData = array_merge($validatedData, ['image' => $ImageName]);
        }
        $this->categoryRepository->store($validatedData);
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->show($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $category = $this->categoryRepository->show($request->id);

        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePath = public_path('categoryImages') . '/' . $category->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('categoryImages'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
            $category->update([
                'name' => $validatedData['name'],
                'image' => $imageName,
                'status' => $request->status == 'on' ? 1 : 0,
            ]);
        } else {
            $category->update([
                'name' => $validatedData['name'],
                'status' => $request->status == 'on' ? 1 : 0,
            ]);
        }
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->show($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
