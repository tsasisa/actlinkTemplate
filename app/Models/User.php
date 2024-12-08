<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'userId';
    public $timestamps = false; // If there's no created_at/updated_at columns

    protected $fillable = [
        'userName',
        'userPassword',
        'userPhoneNumber',
        'userImage',
        'userType',
    ];

    // Relationships

    // Each user can be an admin (if userType = 'Admin')
    public function admin()
    {
        return $this->hasOne(Admin::class, 'adminId', 'userId');
    }

    // Each user can be a member (if userType = 'Member')
    public function member()
    {
        return $this->hasOne(Member::class, 'memberId', 'userId');
    }

    // Each user can be an organizer (if userType = 'Organizer')
    public function organizer()
    {
        return $this->hasOne(Organizer::class, 'organizerId', 'userId');
    }
}
