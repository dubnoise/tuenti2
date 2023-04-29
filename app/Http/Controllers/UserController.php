<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $lastPost = '';
        $duracion = '';

        $lastPost = Post::select('*')->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        if ($lastPost != ''){
            $fecha = $lastPost->created_at;
            $fechaSubida = new Carbon($fecha);
            $fechaActual = Carbon::now();
            $duracion = isset($lastPost) ? Carbon::parse($lastPost->created_at)->locale('es')->diffForHumans(['options' => Carbon::JUST_NOW]) : '';
        }

        $profilePicture = $user->profile_picture ? asset('storage/profile_pictures/'.$user->profile_picture) : null;

        return view ('users.show', compact('user', 'lastPost', 'duracion', 'profilePicture'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
{

    $user->name = $request->input('name');
    $user->surname = $request->input('surname');
    $user->email = $request->input('email');

    if ($request->has('password') && $request->has('password_confirmation')) {
        $user->password = Hash::make($request->input('password'));
    }

    // if ($request->hasFile('profile_picture')) {
    //     $image = $request->file('profile_picture');
    //     $filename = time() . '.' . $image->getClientOriginalExtension();
    //     $path = 'uploads/profile_pictures/' . $filename;
    //     Storage::disk('public')->put($path, file_get_contents($image));

    //     // Actualiza el campo 'profile_picture' del modelo de usuario con la URL de la imagen
    //     $user->profile_picture = $path;
    // }

    if ($request->hasFile('profile_picture')) {
        $profilePicture = $request->file('profile_picture');
        $filename = $profilePicture->getClientOriginalName();
        $profilePicture->storeAs('public/profile_pictures', $filename);
        $user->profile_picture = $filename;
    }

    $user->save();

    return redirect()->route('users.show', $user);
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
