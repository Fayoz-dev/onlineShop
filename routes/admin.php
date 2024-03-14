<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::prefix('stats')->group(function (){
    Route::get('order-count', [StatsController::class, 'ordersCount']);
    Route::get('order-sales-sum', [StatsController::class, 'ordersSalesSum']);
    Route::get('delivery-method-ratio',[StatsController::class,'deliveryMethodRation']);
    Route::get('order-count-by-days',[StatsController::class,'ordersCountByDays']);
});

Route::apiResource('orders', AdminOrderController::class);
