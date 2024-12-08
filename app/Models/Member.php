<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'Member';
    protected $primaryKey = 'memberId';
    public $timestamps = false;

    protected $fillable = [
        'memberDOB',
        'memberPoints'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'memberId', 'userId');
    }

    public function eventParticipants()
    {
        return $this->hasMany(EventParticipant::class, 'memberId', 'memberId');
    }
}
