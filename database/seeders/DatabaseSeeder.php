<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
           RolePermissionSeeder::class,
           CategorySeeder::class,
           UserSeeder::class,
           AttributeSeeder::class,
           ValueSeeder::class,
           ProductSeeder::class,
           DeliveryMethodSeeder::class,
           PaymentTypeSeeder::class,
           StatusSeeder::class,
           SettingSeeder::class,
           PaymentCardTypeSeeder::class,
       ]);
    }
}
