<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


     /**
     * Search for products.
     */
    public function search(Request $request)
    {
        // Validate the request to ensure 'query' is present
        $request->validate([
            'query' => 'required|string|min:3',
        ]);

        $query = $request->input('query');

        // Perform the search query
        $products = Product::where('name', 'like', "%{$query}%")
                           ->orWhere('description', 'like', "%{$query}%")
                           ->paginate(10); // Paginate the results

        return view('products.search-results', compact('products', 'query'));
    }
}
