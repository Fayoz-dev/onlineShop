<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserPaymentCardResource;
use App\Models\UserPaymentCard;
use App\Http\Requests\StoreUserPaymentCardRequest;
use App\Http\Requests\UpdateUserPaymentCardRequest;

class UserPaymentCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        return $this->response(UserPaymentCardResource::collection(auth()->user()->paymentCards));
    }

    public function store(StoreUserPaymentCardRequest $request)
    {
        auth()->user()->paymentCards()->create([
           "number" => encrypt($request->number),
           'name' => encrypt($request->name),
           'exp_date' => encrypt($request->exp_date),
           'holder_name' => encrypt($request->holder_name),
           "payment_card_type_id" => $request->payment_card_type_id,
           'last_four_number' => encrypt(substr($request->number, -4)),
       ]);

       return $this->success('user\'s card created');
    }

    public function show(UserPaymentCard $userPaymentCard)
    {
        //
    }

    public function update(UpdateUserPaymentCardRequest $request, UserPaymentCard $userPaymentCard)
    {
        //
    }

    public function destroy(UserPaymentCard $userPaymentCard)
    {
        //
    }
}
