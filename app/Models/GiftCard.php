<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;
    protected $table = 'gift_cards';
    
    protected $fillable = [
        'code',
        'amount',
        'status',
        'to_mail',
        'expiry_date',
        'from'
       
    ];
}
