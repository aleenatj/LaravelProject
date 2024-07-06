<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable=[
        'category_id',
        'subcategory_name',
        'subcategory_slug',
        'is_child_of',
        'ordering'
    ];
}
