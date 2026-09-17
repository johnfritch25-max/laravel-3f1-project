<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(10)->create();

        // Seed specific products
        //$products = [
           // ['name' => 'Hammer', 'slug' => 'hammer', 'category' => 'Hardware', 'price' => 250, 'quantity' => 50, 'status' => 'Available'],
           // ['name' => 'Extension Wire', 'slug' => 'extension-wire', 'category' => 'Electrical', 'price' => 450, 'quantity' => 30, 'status' => 'Available'],
           // ['name' => 'Water Pipe', 'slug' => 'water-pipe', 'category' => 'Plumbing', 'price' => 180, 'quantity' => 75, 'status' => 'Available'],
       // ];

        //foreach ($products as $product) {
         //   Product::create($product);
       // }

       // $users = User::factory(10)->create();
       // Post::factory(2000)
       // ->recycle($users)
       // ->create();
    }
}
