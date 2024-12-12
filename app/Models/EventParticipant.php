<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eventParticipant extends Model
{
    protected $table = 'eventParticipants';
    protected $primaryKey = 'eventParticipantId';
    public $timestamps = false;

    protected $fillable = [
        'memberId',
        'eventId',
        'registeredDate'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberId', 'memberId');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'eventId', 'eventId');
    }
}
