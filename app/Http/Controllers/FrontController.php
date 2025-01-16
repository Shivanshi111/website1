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
//     public function showFeaturedProducts()
// {
//     // Fetch featured products from the database
//     $featuredProducts = Product::where('is_featured', 1)->get(); // Assuming 'is_featured' is a column indicating featured products

//     // Return the view and pass the featured products
//     return view('your.view.name', compact('featuredProducts'));
// }

   

}