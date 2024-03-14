<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Order $order): bool
    {
        return $order->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('customer') || $user->hasPermissionTo('order:create');
    }

    public function update(User $user, Order $order): bool
    {
        return $order->user_id = $user->id || $user->hasPermissionTo('order:update');
    }

    public function delete(User $user, Order $order): bool
    {
        if ($user->hasRole('customer')){
            return $order->user_id = $user->id && $order->status_id === 1;
        }
        else {
           return $user->hasPermissionTo('order:delete');
        }
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->hasPermissionTo('order:restore');
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->hasPermissionTo('order:forceDelete');
    }
}
