<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // Load the products for the given category
        $products = $category->products()->paginate(9);

        return view('products.by-category', compact('category', 'products'));
    }
}
