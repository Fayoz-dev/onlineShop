<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryMethod::create([
            'name' => [
              'uz' => 'Tekin',
              'en' => 'Free'
            ],
            'estimeted_time' => [
                'uz' => '5 kun',
                'en' => '5 day'
            ],
            'sum' => 0
        ]);

        DeliveryMethod::create([
            'name' => [
              'uz' => 'Standart',
              'en' => 'Standart'
            ],
            'estimeted_time' => [
                'uz' => '3 kun',
                'en' => '3 day'
            ],
            'sum' => 30000,
        ]);

        DeliveryMethod::create([
            'name' => [
              'uz' => 'Tez',
              'en' => 'Fast'
            ],
            'estimeted_time' => [
                'uz' => '1 kun',
                'en' => '1 day'
            ],
            'sum' => 50000,
        ]);

    }
}
