<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extend the base User class
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // Specify the table name
    protected $primaryKey = 'userId'; // Specify the primary key
    public $timestamps = false; // If there's no created_at/updated_at columns

    protected $fillable = [
        'userName',
        'userEmail',
        'userPassword',
        'userPhoneNumber',
        'userImage',
        'userType',
    ];

    /**
     * Customize the password field for Laravel authentication.
     */
    public function getAuthPassword()
    {
        return $this->userPassword; // Use 'userPassword' as the password field
    }

    // Relationships

    // Each user can be an admin (if userType = 'Admin')


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

    public function claimedItems()
    {
        return $this->hasMany(ClaimedItem::class);
    }
}
