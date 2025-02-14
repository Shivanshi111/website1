<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategories;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Display a list of products
    public function index()
    {
        $products = Product::with(['category', 'subcategory', 'brand'])->get();

        return view('admin.product.product_list', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategories::all();
        $brands = Brand::all();

        return view('admin.product.create_product', compact('categories', 'subcategories', 'brands'));
    }

    // Store a new product
    public function store(Request $request)
    {
        // @dd($request);
        // Validate input
        // echo '<pre>';
        // print_r($request->all());
        // die();
       

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'sku' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'qty' => 'nullable|integer',
            'status' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'featured' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('product_images', 'public');
        }
        
        $slug = Str::slug($request->input('title'), '-');
            $product = new Product();
            $product->title = $request->title;
            $product->slug = $slug;
            $product->status = $request->status;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand_id = $request->brand_id;
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->compare_price = $request->input('compare_price');
            $product->sku = $request->input('sku');
            $product->qty = $request->input('qty');
            $product->barcode = $request->input('barcode');
            $product->featured = $request->input('featured');
            $product->image = $image;
           
            $product->save();

            return redirect()->route('products.index')->with('success', 'Sub Category has been created successfully');
        } 
    

    // Show the form for editing an existing product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategories::all();
        $brands = Brand::all();

        return view('admin.product.edit_product', compact('product', 'categories', 'subcategories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'sku' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'qty' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|boolean',
            'featured' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update product fields
        $product->update($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('product_images', 'public');
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('products.index')->with('success', 'products has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }
}
