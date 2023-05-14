<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;

class FriendshipController extends Controller
{
    public function sendRequest(User $user)
    {
        $friendship = Friendship::firstOrCreate([
            'user_id' => auth()->id(),
            'friend_id' => $user->id,
            'status' => 'pending'
        ]);

        return redirect()->back();
    }

    public function cancelRequest(User $user)
    {
        $friendship = Friendship::where([
            'user_id' => auth()->id(),
            'friend_id' => $user->id,
            'status' => 'pending'
        ])->first();

        if ($friendship) {
            $friendship->delete();
        }

        return redirect()->back();
    }

    public function acceptRequest(User $user)
    {
        $friendship = Friendship::where([
            'user_id' => $user->id,
            'friend_id' => auth()->id(),
            'status' => 'pending'
        ])->first();

        if ($friendship) {
            $friendship->update(['status' => 'accepted']);
        }

        return redirect()->back();
    }

    public function rejectRequest(User $user)
    {
        $friendship = Friendship::where([
            'user_id' => $user->id,
            'friend_id' => auth()->id(),
            'status' => 'pending'
        ])->first();

        if ($friendship) {
            $friendship->update(['status' => 'rejected']);
        }

        return redirect()->back();
    }
    public function deleteFriend(User $user)
    {
        $friendship = Friendship::where(function ($query) use ($user) {
            $query->where('user_id', auth()->id())
                ->where('friend_id', $user->id)
                ->where('status', 'accepted');
        })->orWhere(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('friend_id', auth()->id())
                ->where('status', 'accepted');
        })->first();

        if ($friendship) {
            $friendship->delete();
        }

        return redirect()->back();
    }

}
