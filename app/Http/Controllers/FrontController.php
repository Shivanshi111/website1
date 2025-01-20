<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class FrontController extends Controller
{
    public function index(){
       $products = Product::where('featured','Yes')->orderBy('id','ASC')->where('status',1)->take(8)->get();
       $data['featuredProducts'] = $products;

       $latestProducts = Product::orderBy('id','DESC')->where('status',1)->take(8)->get();
       $data['latestProducts'] = $latestProducts;
        return view('front.home',$data);
    }

//     public function search(Request $request)
//     {
//         $query = $request->input('query'); // Get the search input
        
//         // Search Products
//         $products = Product::where('title', 'LIKE', "%{$query}%")
//             ->orWhere('description', 'LIKE', "%{$query}%")
//             ->where('status', 1) // Ensure the product is active
//             ->get();

//         // Search Categories
//         $categories = Category::where('name', 'LIKE', "%{$query}%")
//             ->get();

//         // Search Brands
//         $brands = Brand::where('name', 'LIKE', "%{$query}%")
//             ->get();

//         // Pass all results to the view
//         return view('front.search_results', compact('products', 'categories', 'brands', 'query'));
//     }
// }
//     public function showFeaturedProducts()
// {
//     // Fetch featured products from the database
//     $featuredProducts = Product::where('is_featured', 1)->get(); // Assuming 'is_featured' is a column indicating featured products

//     // Return the view and pass the featured products
//     return view('your.view.name', compact('featuredProducts'));
// }

   
}
