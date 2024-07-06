<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'card_details';
    protected $fillable = [
        'name',
        'card_number',
        'cvv',
        'customer_id',
        'expiry_date'
       
        
    ];
    use HasFactory;
}
