<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryTranslation extends Model
{
    use HasFactory;
    protected $table = 'subcategory_translations';
    protected $fillable = ['subcategory_id', 'locale', 'name'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategories::class);
    }
}    
