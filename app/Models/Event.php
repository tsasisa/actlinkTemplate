<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'Event';
    protected $primaryKey = 'eventId';
    public $timestamps = false;

    protected $fillable = [
        'eventName',
        'eventDescription',
        'eventImage',
        'eventDate',
        'eventLocation',
        'isHeld',
        'eventParticipantQuota',
        'eventParticipantNumber',
        'eventPoints',
        'eventType',
        'eventUpdates',
        'organizerId'
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizerId', 'organizerId');
    }

    public function eventParticipants()
    {
        return $this->hasMany(EventParticipant::class, 'eventId', 'eventId');
    }
}
