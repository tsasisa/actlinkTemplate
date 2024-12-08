<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $table = 'Organizer';
    protected $primaryKey = 'organizerId';
    public $timestamps = false;

    protected $fillable = [
        'organizerAddress',
        'organizerPhoneNumber'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'organizerId', 'userId');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'OrganizerId', 'organizerId');
    }
}
