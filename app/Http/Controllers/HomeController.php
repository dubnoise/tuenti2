<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Picture;
use App\Models\Friendship;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastPost = '';
        $duracion = '';
        $hasProfilePicture = false;
        $user = '';
        $visits = '';

        if (Auth::check()) {
            $user = auth()->user();
            $userFriends = $user->friends()->wherePivot('status', 'accepted')->pluck('friend_id')->toArray();
            $friendFriends = Friendship::whereIn('friend_id', $userFriends)
                ->where('user_id', '!=', $user->id)
                ->where('status', 'accepted')
                ->pluck('user_id')->toArray();
            $friends = array_unique(array_merge($userFriends, $friendFriends));

            $posts = Post::whereIn('user_id', $friends)->orderBy('created_at', 'desc')->get();
            $pictures = Picture::whereIn('user_id', $friends)->orderBy('created_at', 'desc')->get();

            $visits = DB::table('visits')->where('user_id', $user->id)->count();

            $lastPost = Post::select('*')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
            if ($lastPost != '') {
                $fecha = $lastPost->created_at;
                $fechaSubida = new Carbon($fecha);
                $fechaActual = Carbon::now();
                $duracion = isset($lastPost) ? Carbon::parse($lastPost->created_at)->locale('es')->diffForHumans(['options' => Carbon::JUST_NOW]) : '';
            }
            $hasProfilePicture = file_exists(public_path('storage/profile_pictures/'.auth()->user()->profile_picture));
        } else {
            $posts = Post::select('*')->orderBy('created_at', 'desc')->get();
            $pictures = Picture::select('*')->orderBy('created_at', 'desc')->get();
        }

        return view('home', compact('posts', 'pictures', 'lastPost', 'duracion', 'hasProfilePicture', 'user', 'visits'));
    }




    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
