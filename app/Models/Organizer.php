<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $table = 'organizers';
    protected $primaryKey = 'organizerId';
    public $timestamps = false;

    protected $fillable = [
        'organizerAddress',
        'organizerPhoneNumber',
        'officialSocialMedia',
        'activeFlag'
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
