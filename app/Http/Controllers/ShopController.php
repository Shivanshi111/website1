<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->categorySlug;
        $subCategorySlug = $request->subCategorySlug;
        $priceMin = $request->get('price_min', 0); // Default to 0
    $priceMax = $request->get('price_max', 1000); // Default to 1000
    $sort = $request->get('sort', 'latest'); // Default to "latest"

        $brandsArray = [];
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand')); 
        }

        $categories = Category::orderBy('name', 'ASC')
            ->with('subcategories')
            ->where('status', 1)
            ->get();
    
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();
 
        $productsQuery = Product::where('status', 1);

        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
    
            if ($category) {
                $productsQuery->where('category_id', $category->id);
            } else {
                return abort(404, 'Category not found.');
            }
        }

        if ($subCategorySlug) {
            $subcategory = Subcategories::where('slug', $subCategorySlug)->first();
    
            if ($subcategory) {
                $productsQuery->where('subcategory_id', $subcategory->id);
            } else {
                return abort(404, 'Subcategory not found.');
            }
        }

        if (!empty($brandsArray)) {
            $productsQuery->whereIn('brand_id', $brandsArray);
        }

        $productsQuery->whereBetween('price', [$priceMin, $priceMax]);
        if ($sort === 'price_asc') {
            $productsQuery->orderBy('price', 'ASC');
        } elseif ($sort === 'price_desc') {
            $productsQuery->orderBy('price', 'DESC');
        } else {
            $productsQuery->orderBy('id', 'DESC'); // Default to latest
        }
    
        $products = $productsQuery->orderBy('id', 'DESC')->get();
    
        return view('front.shop', compact('categories', 'brands', 'products', 'brandsArray','priceMin', 'priceMax','sort'));
    }

      public function showFeaturedProducts($slug){
      
    $product = Product::where('slug', $slug)->first();
    
    return view('front.account.product', compact('product'));
    if (!$product) {
        return abort(404, 'Product not found.');
    }

    return view('front.product', compact('product'));
}
      }
