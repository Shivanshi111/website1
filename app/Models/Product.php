<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
  
    protected $fillable = [
        'title',
        'description',
        'price',
        'compare_price',
        'image',
        'qty',
        'status',
        'sku',
        'featured',
        'category_id',
        'subcategory_id',
        'brand_id',
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategories::class, 'subcategory_id');
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

}