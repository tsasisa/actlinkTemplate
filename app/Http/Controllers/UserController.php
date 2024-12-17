<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile($userId)
    {
        $user = User::findOrFail($userId);
        $member = Member::where('memberId', $user->userId)->first();
        $organizer = Organizer::where('organizerId', $user->userId)->first();

        return view('registered.profile', compact('user', 'member', 'organizer'));
    }
}
