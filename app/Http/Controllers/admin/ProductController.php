<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategories;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductTranslation;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ProductController extends Controller
{
    // Display a list of products
    public function index(Request $request){
        $query = $request->get('query');
    
        // Perform the search query
        $products = Product::where('title', 'LIKE', "%$query%")
                           ->paginate(5);
    
        // If it's an AJAX request, return only the view without the full page
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.product.product_search', compact('products'))->render()
            ]);
        }
        // dd('This is not an AJAX request');
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

            $this->createTranslations($product, $request->title, $request->description);
            return redirect()->route('products.index')->with('success', 'Sub Category has been created successfully');
        } 
        private function createTranslations($product, $name, $description = null)
        {
            $translator = new GoogleTranslate();
            $languages = ['hi', 'pa']; // Languages to support
    
            foreach ($languages as $locale) {
                $translator->setTarget($locale);
                $translatedName = $translator->translate($name);
                $translatedDescription = $description ? $translator->translate($description) : null;
    
                ProductTranslation::updateOrCreate(
                    ['product_id' => $product->id, 'locale' => $locale],
                    ['name' => $translatedName, 'description' => $translatedDescription]
                );
            }
        }
    
    

    // Show the form for editing an existing product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategories::all();
        $brands = Brand::all();
        $translations = $product->translations()->get();  

        return view('admin.product.edit_product', compact('product', 'categories', 'subcategories', 'brands','translations'));
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
        $this->createTranslations($product, $request->title, $request->description);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

  
    // In ProductController.php
public function show($id)
{
    // Find the product by its ID
    $product = Product::with(['category', 'subcategory', 'brand'])->findOrFail($id);

    // Return the product details view with the product data
    return view('admin.product.show_product', compact('product'));
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
