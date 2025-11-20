<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i<10; $i++) {
            Product::create([
                'name' => $faker->words(2, true),
                'price'=> $faker->numberBetween(10000, 200000),
                'stock'=> $faker->numberBetween(1, 50),
            ]);
        }
    }
}
