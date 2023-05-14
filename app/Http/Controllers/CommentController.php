<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $profileUser = User::findOrFail($user->id);

        if (Auth::check() && Auth::user()->id != $profileUser->id) {
            $userFriends = $profileUser->friends()->wherePivot('status', 'accepted')->pluck('friend_id')->toArray();

            if (in_array(Auth::user()->id, $userFriends)) {
                $comment = new Comment();
                $comment->user_id = Auth::user()->id;
                $comment->profile_user_id = $profileUser->id;
                $comment->content = $request->input('content');
                $comment->save();
            }
        }

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comments)
    {
        //
    }
}
