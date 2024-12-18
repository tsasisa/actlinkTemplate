<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    protected $table = 'shop_items';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image'
    ];

    public $timestamps = false;
}
