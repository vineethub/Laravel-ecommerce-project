<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Display the specified product and track the view.
     */
    public function show(Product $product)
    {
        // The key for the recently viewed list
        $listKey = 'recently_viewed:' . session()->getId();

        // 1. Add the product ID to the front of the list
        Redis::lpush($listKey, $product->id);

        // 2. Trim the list to only keep the last 5 viewed products
        Redis::ltrim($listKey, 0, 4);

        return view('products.show', compact('product'));
    }
}
