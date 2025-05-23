<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart_items";
    protected $fillable = ['user_id', 'product_id', 'quantity'];
}
