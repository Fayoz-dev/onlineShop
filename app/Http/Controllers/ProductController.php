<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return ProductResource::collection(Product::cursorPaginate(25));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->toArray());

        return $this->success(data: new ProductResource($product));
    }

    public function show($id)
    {
        return new ProductResource(Product::with('stocks')->find($id));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        Gate::authorize('product:delete');

        $product->photos()->delete();
        $product->delete();

        return $this->success('product deleted');
    }

    public function related()
    {

    }
}
