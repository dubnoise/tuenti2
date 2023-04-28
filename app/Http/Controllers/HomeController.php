<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Picture;
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

        $posts = Post::select('*')->orderBy('created_at', 'desc')->get();
        $users = User::all();
        $pictures = Picture::select('*')->orderBy('created_at', 'desc')->get();

        $lastPost = '';
        $duracion = '';
        if (Auth::check()){
            $lastPost = Post::select('*')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
            $fecha = $lastPost->created_at;

            $fechaSubida = new Carbon($fecha);
            $fechaActual = Carbon::now();
            $duracion = isset($lastPost) ? Carbon::parse($lastPost->created_at)->locale('es')->diffForHumans(['options' => Carbon::JUST_NOW]) : '';
        }

        return view('home', compact('posts', 'users', 'pictures', 'lastPost', 'duracion'));
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
        // // Crear un nuevo post y guardarlo en la base de datos
        // $post = new Post;
        // $post->content = $request->content;
        // $post->save();

        // // Redirigir al usuario a la página de inicio
        // return redirect()->route('home');
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
