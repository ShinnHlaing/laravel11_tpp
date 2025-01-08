<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        $data = ProductResource::collection($products);
        return $this->success($data, "Product Retrieved Success", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Error', $validator->errors(), 422);
        }
        if ($request->hasFile('image')) {
            $imageName = time() . $request->image->extension();
            $request->image->move(public_path('productImages'), $imageName);
            $product = Product::create([
                'name' => $request->name,
                'image' => $imageName,
            ]);
            return $this->success($product, "Product Created successfully", 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error('Product not found', null, 404);
        }
        $data = new ProductResource($product);
        return $this->success($data, "Product Show Successfully", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Error', $validator->errors(), 422);
        }
        $product = Product::find($id);
        if (!$product) {
            return $this->error('Product not found', null, 404);
        }
        $product->update($request->all());
        return $this->success($product, "Product Updated Successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error('Product not found!', null, 404);
        };
        $product->delete();
        return $this->success($product, "Product destory successfully", 200);
    }
}
