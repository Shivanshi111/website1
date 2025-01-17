<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';

   
    protected $fillable = ['name', 'slug', 'status'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function translations()
    {
        return $this->hasMany(BrandTranslation::class);
    }

    public function getTranslatedNameAttribute()
    {
        return $this->translations->firstWhere('locale', app()->getLocale())?->name ?? $this->name;
    }
}
