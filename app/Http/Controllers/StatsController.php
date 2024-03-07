<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\LazyCollection;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function ordersCount(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        if ($request->has(['from','to'])){
            $from = $request->from;
            $to = $request->to;
        }
        return $this->response(
            Order::query()
                ->whereBetween('created_at',[$from, Carbon::parse($to)->endOfDay()])
                ->whereRelation('status','code','waiting_payment')
                ->count()
        );
    }

    public function ordersSalesSum(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        if ($request->has(['from','to'])){
            $from = $request->from;
            $to = $request->to;
        }

        return $this->response(
          Order::query()
          ->whereBetween('created_at',[$from, Carbon::parse($to)->endOfDay()])
          ->whereRelation('status','code', 'waiting_payment')
          ->sum('sum')
        );
    }

    public function deliveryMethodRation(Request $request)
    {
//        if (Cache::has('deliveryMethodRation')){
//            return Cache::get('deliveryMethodRation');
//        }

        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        if ($request->has(['from','to'])){
            $from = $request->from;
            $to = $request->to;
        }

        $response = [];

        $allOrders = Order::query()->whereBetween('created_at',[$from, Carbon::parse($to)->endOfDay()])
            ->whereRelation('status','code', 'waiting_payment')->count();

        foreach (DeliveryMethod::all() as $deliveryMethod)
        {
            $deliveryMethodOrders = $deliveryMethod
                ->orders()
                ->whereBetween('created_at',[$from, Carbon::parse($to)->endOfDay()])
                ->whereRelation('status','code', 'waiting_payment')
                ->count();

            $response[] = [
                'name' => $deliveryMethod->getTranslations('name'),
                'percentage' => $deliveryMethodOrders*100 / $allOrders .' %',
                'amount' => $deliveryMethodOrders,
            ];
        }

//        Cache::put('deliveryMethodRation', $response , Carbon::now()->addDay());

        return $this->response($response);

    }

    public function ordersCountByDays(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        if ($request->has(['from','to'])){
            $from = $request->from;
            $to = $request->to;
        }

        $days = CarbonPeriod::create($from,$to);
        $response = new Collection();

        LazyCollection::make($days->toArray())->each(function ($day) use ($from,$to , $response){
           $count = Order::query()
               ->where('created_at', $day->format('Y-m-d'))
               ->whereRelation('status', 'code' , 'waiting_payment')
               ->count();

           $response[] = [
               'date' => $day->format('Y-m-d'),
               'order_count' => $count,
           ];
        });
       return $this->response($response);

    }
}
