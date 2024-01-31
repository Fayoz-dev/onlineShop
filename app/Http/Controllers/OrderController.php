<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\UserAddress;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return auth()->user()->orders;
    }

    public function store(StoreOrderRequest $request)
    {
        $sum = [];
        $products = [];
        $address = UserAddress::find($request->address_id);

        foreach ($request['products'] as $product)
        {
            $prod = Product::with('stocks')->find($product['product_id']);
            if (
                $prod->stocks()->find($product['stock_id']) &&
                $prod->stocks()->find($product['stock_id'])->quentity >=$product['quentity']
            )
            {
                $productWithStock = $prod->withStock($product['stock_id']);
                $productResource = new ProductResource($productWithStock);

                $sum += $productResource['price'];
                $product[] = $productResource->resolve();
            }
        }

        auth()->user()->orders()->create([
            'comment' => $request -> comment,
            'delivery_method_id' => $request -> delivery_method_id,
            'payment_type_id' => $request -> payment_type_id,
            'address' => $address,
            'sum' => $sum,
            'products' => $products
        ]);
        return 'success';
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
