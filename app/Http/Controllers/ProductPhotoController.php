<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPhotosRequest;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Product $product)
    {
        return $this->response($product->photos);
    }

    public function store(StoreProductPhotosRequest $request, Product $product)
    {
        foreach ($request->photos as $photo) {
            $path = $photo->store('products/'. $product->id, 'public');
            $fullName = $photo->getClientOriginalName();

            $product->photos()->create([
               'full_name' => $fullName,
                'path' => $path
            ]);
        }
    }

    public function destroy(Product $product, Photo $photo)
    {
        Gate::authorize('product:delete');
        Storage::delete($product->photos()->pluck('path')->toArray());
        $product->photos()->delete();
        $photo->delete();
        return $this->success('Photo deleted');
    }
}
