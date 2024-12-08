<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'Admin';
    protected $primaryKey = 'adminId';
    public $timestamps = false;

    // No additional fillable fields given besides the PK, but you can add if you have more
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'adminId', 'userId');
    }
}
