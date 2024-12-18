<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class claimedItem extends Model
{
    protected $fillable = ['userId', 'itemId'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(ShopItem::class);
    }
}
