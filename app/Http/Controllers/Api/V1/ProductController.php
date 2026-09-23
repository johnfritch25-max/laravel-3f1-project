<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return $this->ok(
            'Products retrieved successfully',
            ProductResource::collection($products)
        );
    }

    public function show(Product $product)
    {
        $product->load('category');

        return $this->ok('Product retrieved successfully', new ProductResource($product));
    }

    public function queries()
    {
        $nameAndPrice = Product::select('name', 'price')->get();
        $productsWithCategory = Product::with('category')->get();
        $productsOrderedByPrice = Product::select('id', 'name')->orderBy('price')->get();
        $firstFiveProducts = Product::limit(5)->get();
        $priceGreaterThanOrEqual = Product::where('price', '>=', 3)->get();
        $electronics = Product::whereHas('category', fn ($query) => $query->where('name', 'Electronics'))->get();
        $totalPrice = round((float) Product::sum('price'), 2);
        $averagePrice = round((float) Product::avg('price'), 2);
        $highestPrice = round((float) Product::max('price'), 2);
        $lowestPrice = round((float) Product::min('price'), 2);

        $totalPricePerCategory = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(products.price) as total_price'))
            ->groupBy('categories.name')->get()
            ->each(fn ($item) => $item->total_price = round((float) $item->total_price, 2));

        $averagePricePerCategory = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('AVG(products.price) as avg_price'))
            ->groupBy('categories.name')->get()
            ->each(fn ($item) => $item->avg_price = round((float) $item->avg_price, 2));

        $lowestPricePerCategory = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('MIN(products.price) as min_price'))
            ->groupBy('categories.name')->get()
            ->each(fn ($item) => $item->min_price = round((float) $item->min_price, 2));

        $averagePriceSorted = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('AVG(products.price) as avg_price'))
            ->groupBy('categories.name')->orderBy('avg_price')->get()
            ->each(fn ($item) => $item->avg_price = round((float) $item->avg_price, 2));

        $electronicsAndBooks = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->whereIn('categories.name', ['Electronics', 'Books'])
            ->select('categories.name', DB::raw('AVG(products.price) as avg_price'))
            ->groupBy('categories.name')->get()
            ->each(fn ($item) => $item->avg_price = round((float) $item->avg_price, 2));

        return $this->success('Query results retrieved successfully', compact(
            'nameAndPrice', 'productsWithCategory', 'productsOrderedByPrice', 'firstFiveProducts',
            'priceGreaterThanOrEqual', 'electronics', 'totalPrice', 'averagePrice', 'highestPrice',
            'lowestPrice', 'totalPricePerCategory', 'averagePricePerCategory', 'lowestPricePerCategory',
            'averagePriceSorted', 'electronicsAndBooks'
        ));
    }
}