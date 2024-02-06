<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\Stock;
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
        $sum = 0;
        $products = [];
        $notFoundProducts = [];
        $address = UserAddress::find($request->address_id);

        foreach ($request['products'] as $requestProduct) {
            $product = Product::with('stocks')->findOrFail($requestProduct['product_id']);
            $product->quentity = $requestProduct['quentity'];
            if (
                $product->stocks()->find($requestProduct['stock_id']) &&
                $product->stocks()->find($requestProduct['stock_id'])->quentity >= $requestProduct['quentity']
            ) {
                $productWithStock = $product->withStock($requestProduct['stock_id']);
                $productResource = new ProductResource($productWithStock);
                $sum += $productResource['price'];
                $products[] = $productResource->resolve();
            }
            else {
                $requestProduct['we_have'] = $product->stocks()->find($requestProduct['stock_id'])->quentity;
                $notFoundProducts [] = $requestProduct;
            }
        }

        if ($notFoundProducts === [] && $products !== [] && $sum !== 0) {
            $order = auth()->user()->orders()->create([
                'comment' => $request->comment,
                'delivery_method_id' => $request->delivery_method_id,
                'payment_type_id' => $request->payment_type_id,
                'address' => $address,
                'sum' => $sum,
                'status_id' => in_array($request['payment_type_id'],[1,2]) ? 1:10,
                'products' => $products
            ]);
            if ($order) {
                foreach ($products as $product) {
                    $stock = Stock::find($product['inventory'][0]['id']);
                    $stock->quentity -= $product['order_quantity'];
                    $stock->save();
                }
            }
            return 'success';
        }
        else {

            return response([
                'success' => false,
                'message' => 'some products not found or does not have in inventory',
                'products' => $notFoundProducts,
            ]);
        }
        return 'something went wrong, cant create order';
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
