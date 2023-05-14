<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
    public static function befriend($userId, $friendId)
{
    $friendship = new Friendship();
    $friendship->user_id = $userId;
    $friendship->friend_id = $friendId;
    $friendship->status = 'pending';
    $friendship->save();

    return $friendship;
}

public static function acceptFriendRequest($userId, $friendId)
{
    $friendship = Friendship::where('user_id', $friendId)
        ->where('friend_id', $userId)
        ->first();

    if (!$friendship) {
        return false;
    }

    $friendship->status = 'accepted';
    $friendship->save();

    return $friendship;
}

public static function unfriend($userId, $friendId)
{
    $friendship1 = Friendship::where('user_id', $userId)
        ->where('friend_id', $friendId)
        ->first();

    $friendship2 = Friendship::where('user_id', $friendId)
        ->where('friend_id', $userId)
        ->first();

    if ($friendship1) {
        $friendship1->delete();
    }

    if ($friendship2) {
        $friendship2->delete();
    }
}

}
