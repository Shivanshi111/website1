<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'Please log in to add to wishlist']);
        }

        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
        if ($exists) {
            return response()->json(['status' => false, 'message' => 'Product already in wishlist']);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
        

        return response()->json(['status' => true, 'message' => 'Added to wishlist']);
    }

    public function viewWishlist()
    {
        $wishlistItems = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('front.home', compact('wishlistItems'));
    }

    public function removeFromWishlist($id)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();
        if ($wishlistItem) {
            $wishlistItem->delete();
        }

        return redirect()->route('front.home')->with('success', 'Product removed from wishlist');
    }
}

