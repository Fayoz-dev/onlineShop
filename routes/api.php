<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentCardTypeController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPhotoController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPaymentCardController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;

    Route::get('products/{product}/related', [ProductController::class, 'related']);
    Route::post('permissions/assign', [PermissionController::class, 'assign']);
    Route::post('roles/assign', [RoleController::class, 'assign']);

Route::apiResources([
    'users' => UserController::class,
    'roles' => RoleController::class,
    'orders' => OrderController::class,
    'reviews' => ReviewController::class,
    'statuses' => StatusController::class,
    'products' => ProductController::class,
    'settings' => SettingController::class,
    'favorites' => FavoriteController::class,
    'permissions' => PermissionController::class,
    'categories' => CategoryController::class,
    'discounts' => DiscountController::class,
    'payment-types' => PaymentTypeController::class,
    'user-addresses' => UserAddressController::class,
    'user-settings' => UserSettingController::class,
    'products.photos' => ProductPhotoController::class,
    'statuses.orders' => StatusOrderController::class,
    'products.reviews' => ProductReviewController::class,
    'delivery-methods' => DeliveryMethodController::class,
    'categories.products' => CategoryProductController::class,
    'user-payment-cards' => UserPaymentCardController::class,
    'payment-card-types' => PaymentCardTypeController::class,

]);

