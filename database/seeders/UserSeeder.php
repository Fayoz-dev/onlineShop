<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
               'first_name' => 'Admin',
               'last_name' => 'Admin',
               'email' => 'admin@ecom.uz',
               'phone' => '+99999999',
               'password' => Hash::make('secret')
        ]);

        $admin->roles()->attach(1);

             $customer = User::create([
               'first_name' => 'customer',
               'last_name' => 'customer',
               'email' => 'customer@ecom.uz',
               'phone' => '123456789',
               'password' => Hash::make('secret')
        ]);

        $customer->roles()->attach(2);

        User::factory()->count(10)->hasAttached(Role::find(2))->create();
    }
}
