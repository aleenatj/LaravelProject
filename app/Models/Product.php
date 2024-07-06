<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'price',
        
    ];
    use HasFactory;
  
   
    public function orders()
    {
        return $this->belongsToMany(Orders::class, 'order_product', 'product_id', 'order_id');
    }
    public function categories()
    {
        
    return $this->belongsToMany(Category::class, 'product_category')
    ->withPivot('position')
    ->orderBy('product_category.position', 'ASC');
    }
    public function product_ratings(){
        return $this->hasMany(ProductRating::class)->where('status',1);
    }
}
