<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Customer extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait;

    protected $table = 'customer';
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id'
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
