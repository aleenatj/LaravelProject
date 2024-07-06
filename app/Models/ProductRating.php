<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;
    protected $table = 'product_rating';
    protected $fillable = [
        
        'product_id',
        'name',
        'email',
        'rating',
        'comment',
        'status'
        
     
    ];
}
