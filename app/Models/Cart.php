<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts'; // This specifies the table name, though Laravel assumes this automatically
    protected $fillable = [
        'user_id',
        'product_id',
        'image',
        'price',
        'quantity',
    ];

    /**
     * Relationship with Product Model
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}


