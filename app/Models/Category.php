<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    // Specify the fields that are mass assignable
    protected $fillable = ['name', 'slug', 'image', 'status'];
    public function subcategories()
    {
        return $this->hasMany(Subcategories::class, 'categories_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'subcategory_id','id');
    }
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
}

