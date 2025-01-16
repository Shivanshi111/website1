<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\WishlistController;


Route::middleware('auth.redirect')->group(function () {
Route::get('/user_login', [AuthController::class, 'login'])->name('account.login');
Route::post('/user_login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/register',[AuthController::class,'register'])->name('account.register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
Route::post('/user_logout', [AuthController::class, 'logout'])->name('user_logout');
});

Route::group(['middleware' => 'auth.redirect'], function () {
Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('/shop', [ShopController::class, 'index'])->name('front.shop');
Route::get('/product/{slug}', [ShopController::class, 'showFeaturedProducts'])->name('products.show');


Route::post('/add-to-cart', [CardController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CardController::class, 'cart'])->name('front.cart');
Route::delete('/cart/remove/{id}', [CardController::class, 'removeFromCart'])->name('cart.remove');

});
Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'auth.redirect'], function () {
      
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'Admin'], function () {
        
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard'); // Define the admin dashboard route
        Route::post('/logout', [HomeController::class, 'logout'])->name('admin.logout'); // Define the admin dashboard route

        //category routes
        Route::get('/categories/list',[CategoryController::class,'index'])->name('categories.index');
        Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');

        Route::post('/categories/create',[CategoryController::class,'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories/delete_category/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

        Route::get('/category/subcategory/list',[SubCategoryController::class,'index'])->name('subcategories.index');
        Route::get('/create_Sub_categories/list',[SubCategoryController::class,'create'])->name('subcategories.create');
        Route::post('/New_Subcategories/list',[SubCategoryController::class,'store'])->name('subcategories.store');
        Route::get('/subcategories/{id}/edit',[SubCategoryController::class,'edit'])->name('subcategories.edit');
        Route::post('/subcategories/{id}/update',[SubCategoryController::class,'update'])->name('subcategories.update');
        Route::get('/subcategories/delete_subcategory/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.delete');

        Route::get('/brand/list',[BrandsController::class,'index'])->name('brand.index');
        Route::get('/brand/create',[BrandsController::class,'create'])->name('brand.create');
        Route::post('/brand/store',[BrandsController::class,'store'])->name('brand.store');
        Route::get('/brand/{id}/edit',[BrandsController::class,'edit'])->name('brand.edit');
        Route::put('/brand/{id}/update',[BrandsController::class,'update'])->name('brand.update');
        Route::get('/brand/delete_brand/{id}', [BrandsController::class, 'destroy'])->name('brand.delete');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); 
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store'); 
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); 
    Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update'); 
    Route::get('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show2');
 
    });
 
});


Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

