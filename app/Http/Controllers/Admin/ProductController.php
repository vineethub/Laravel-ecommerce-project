<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   /** Display a listing of the resource. */
   public function index()
   {
       $products = Product::with('categories')->latest()->paginate(10);
       return view('admin.products.index', compact('products'));
   }

   /** Show the form for creating a new resource. */
   public function create()
   {
       $categories = Category::all();
       return view('admin.products.create', compact('categories'));
   }

   /** Store a newly created resource in storage. */
   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'required|string',
           'price' => 'required|numeric|min:0',
           'categories' => 'required|array|exists:categories,id',
       ]);

       $product = Product::create($request->only('name', 'description', 'price'));
       $product->categories()->sync($request->categories);

       return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
   }

   /** Show the form for editing the specified resource. */
   public function edit(Product $product)
   {
       $categories = Category::all();
       $product->load('categories'); // Eager load the categories for the product
       return view('admin.products.edit', compact('product', 'categories'));
   }

   /** Update the specified resource in storage. */
   public function update(Request $request, Product $product)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'required|string',
           'price' => 'required|numeric|min:0',
           'categories' => 'required|array|exists:categories,id',
       ]);

       $product->update($request->only('name', 'description', 'price'));
       $product->categories()->sync($request->categories);

       return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
   }

   /** Remove the specified resource from storage. */
   public function destroy(Product $product)
   {
       $product->delete();
       return back()->with('success', 'Product deleted successfully.');
   }
}
