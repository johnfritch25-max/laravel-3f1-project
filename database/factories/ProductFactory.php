<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Hardware',
            'Electrical',
            'Plumbing',
        ];

        $products = [
            [
                'category' => $categories[0],
                'name' => 'hammer',
                'price' => 250,
            ],
            [
                'category' => $categories[1],
                'name' => 'extension wire',
                'price' => 450,
            ],
            [
                'category' => $categories[2],
                'name' => 'water pipe',
                'price' => 180,
            ],
        ];
        $product = $this->faker->randomElement($products);

        $name = ucwords(
            strtolower($product['name'])
        );
        return [
            'name' => $name,

            'slug' => Str::slug($name),
            'category' => ucwords(strtolower
            ($product['category'])
            ),
            'price' => $product['price'],
            'quantity' => $this->faker->numberBetween(1, 100),
            'status' => 'Available',
        ];
    }
}
