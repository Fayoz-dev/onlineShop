<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use Illuminate\Database\Eloquent\Collection;

class UserAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return auth()->user()->adresses;
    }

    public function store(StoreUserAddressRequest $request)
    {
        auth()->user()->adresses()->create($request->toArray());
        return true;
    }

    public function show(UserAddress $userAddress)
    {
        //
    }

    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        //
    }

    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
