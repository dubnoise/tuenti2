<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'country',
        'city',
        'birthdate',
        'genre',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'profile_user_id');
    }

    /**
     * Get the messages for the user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the pictures for the user.
     */
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * Get the friends of the user.
     */
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
                    ->withPivot('status')
                    ->wherePivot('status', 'accepted');
    }

    /**
     * Get the friend requests of the user.
     */
    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->wherePivot('status', 'pending')
            ->withPivot('status');
    }

    /**
     * Get the friend requests sent by the user.
     */
    public function friendRequestsSent()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('status', 'pending')
            ->withPivot('status');
    }

    /**
     * Determine if the user is a friend of another user.
     */
    public function isFriendWith(User $user)
    {
        return Friendship::where(function ($query) use ($user) {
            $query->where('user_id', $this->id)
                ->where('friend_id', $user->id)
                ->where('status', 'accepted');
        })->orWhere(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('friend_id', $this->id)
                ->where('status', 'accepted');
        })->exists();
    }


    /**
     * Determine if the user has a friend request from another user.
     */
    public function hasFriendRequestFrom(User $user)
    {
        return $this->friendRequests->contains($user);
    }

    /**
     * Determine if the user has sent a friend request to another user.
     */
    public function hasFriendRequestSentTo(User $user)
    {
        return $this->friendRequestsSent->contains($user);
    }

    public function pendingFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->wherePivot('status', 'pending')
            ->withPivot('status');
    }
}
