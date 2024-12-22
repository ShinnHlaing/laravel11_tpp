<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function index()
    {
        $products = $this->productRepository->index();

        return view('products.index', compact('products'));
    }
    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['status'] = $request->has('status') ? true : false;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('productImages'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $this->productRepository->store($validatedData);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = $this->productRepository->show($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $product = $this->productRepository->show($request->id);
        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImgPath = public_path('productImages') . '/' . $product->image;
                if (file_exists($oldImgPath)) {
                    unlink($oldImgPath);
                }
            };
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('productImages'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'image' => $imageName,
                'status' => $request->status == 'on' ? 1 : 0,
            ]);
        } else {
            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'status' => $request->status == 'on' ? 1 : 0,
            ]);
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = $this->productRepository->show($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
