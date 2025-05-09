<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        return [
            'ProductID' => fake()->unique(),
            'ProductIMG' => fake()->name(),
            'ProductName' => fake()->unique(),
            'Type' => fake()->unique(),
            'Description' => fake()->unique(),
            'SupplierID' => fake()->unique(),
            'UnitPrice' => fake()->unique(),
            'UnitsInStock' => fake()->unique(),
            'UnitsOnOrder' => fake()->unique(),
            'ReorderLevel' => fake()->unique(),
            'Discontinued' => fake()->unique(),
        ];
    }
    
}
