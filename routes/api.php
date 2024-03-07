<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentCardTypeController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserPaymentCardController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'orders' => OrderController::class,
    'reviews' => ReviewController::class,
    'statuses' => StatusController::class,
    'products' => ProductController::class,
    'settings' => SettingController::class,
    'favorites' => FavoriteController::class,
    'categories' => CategoryController::class,
    'payment-types' => PaymentTypeController::class,
    'user-addresses' => UserAddressController::class,
    'user-settings' => UserSettingController::class,
    'statuses.orders' => StatusOrderController::class,
    'products.reviews' => ProductReviewController::class,
    'delivery-methods' => DeliveryMethodController::class,
    'categories.products' => CategoryProductController::class,
    'user-payment-cards' => UserPaymentCardController::class,
    'payment-card-types' => PaymentCardTypeController::class,

]);

