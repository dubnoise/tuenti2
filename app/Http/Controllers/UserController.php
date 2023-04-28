<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $messages = Message::all();
        return view ('users.index', compact('users', 'messages'));
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
    public function show(User $user)
    {
        $lastPost = Post::select('*')->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        $fecha = $lastPost->created_at;
        $fechaSubida = new Carbon($fecha);
        $fechaActual = Carbon::now();
        $duracion = isset($lastPost) ? Carbon::parse($lastPost->created_at)->locale('es')->diffForHumans(['options' => Carbon::JUST_NOW]) : '';

        return view ('users.show', compact('user', 'lastPost', 'duracion'));
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
    public function search(Request $request)
    {
        $users = User::where('name', 'like', '%'.$request->input('q').'%')
            ->orWhere('email', 'like', '%'.$request->input('q').'%')
            ->get();

        return view('users.search', ['users' => $users]);
    }


}
