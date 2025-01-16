<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart; // Cart model
// use Gloudemans\Shoppingcart\Facades\Cart as CartFacade;

class CardController extends Controller
{
    public function addToCart(Request $request)
{
    $product = Product::find($request->id);

    if ($product == null) {
        return response()->json([
            'status' => false,
            'message' => 'Product not found'
        ]);
    }

    // Get the authenticated user's ID
    $userId = auth()->check() ? auth()->user()->id : null;

    if (!$userId) {
        return response()->json([
            'status' => false,
            'message' => 'User not authenticated'
        ]);
    }

    // Check if the product is already in the user's cart
    $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $product->id)->first();

    if ($existingCartItem) {
        return response()->json([
            'status' => false,
            'message' => 'Product is already in your cart'
        ]);
    }

    // Save product to the 'carts' table
    $cartItem = Cart::create([
        'user_id' => $userId,
        'product_id' => $product->id,
        'image' => $product->image,
        'price' => $product->price,
        'quantity' => 1, // Default quantity
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Product added to cart successfully.',
        'cartCount' => Cart::where('user_id', $userId)->count(), // Return cart item count
    ]);
}



public function cart()
{
    // Get the authenticated user's ID
    $userId = auth()->check() ? auth()->user()->id : null;

    if (!$userId) {
        return redirect()->route('account.login')->with('error', 'Please login to view your cart.');
    }

    // Get the user's cart items
    $cartItems = Cart::where('user_id', $userId)->get();

    return view('front.cart', compact('cartItems'));
}

public function removeFromCart($id)
{
    $cartItem = Cart::find($id);

    if ($cartItem) {
        $cartItem->delete();
    }

    return redirect()->route('front.cart')->with('success', 'Item removed from cart.');
}

}
