<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->middleware('permission:productList', ['only' => ['index']]);
        $this->middleware('permission:productCreate', ['only' => ['store']]);
        $this->middleware('permission:productEdit', ['only' => ['update']]);
        $this->middleware('permission:productDelete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $products = Product::with('category')->get();
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
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
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
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
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
        $product = Product::with('category')->where('id', $id)->first();
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
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Error', $validator->errors(), 422);
        }
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return $this->error('Product not found', null, 404);
        }
        $product->update($request->all());
        return $this->success($product, "Product Updated Successfully", 200);
    }

    public function imageUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'required|image',
        ]);

        $product = Product::where('id', $id)->first();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('productImages'), $imageName);

            $data = array_merge($data, ['image' => $imageName]);
        }

        $product->update([
            'image' => $imageName
        ]);

        return $this->success($product, "Image Update Successfully", 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id);
        if (!$product) {
            return $this->error('Product not found!', null, 404);
        };
        $product->delete();
        return $this->success($product, "Product destory successfully", 200);
    }
}
