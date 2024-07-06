<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCard extends Model
{
    use HasFactory;
    protected $table = 'order_card';
    
    protected $fillable = [
        'code',
        'amount',
        'status',
        'to_mail',
        'usage',
        
       
    ];
}
