<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'categories_id','name','slug','status'
    ];
    public function category()
{
    return $this->belongsTo(Category::class, 'categories_id', 'id');
}
public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

}




