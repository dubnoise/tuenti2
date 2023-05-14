<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Post;
use App\Models\Visit;
use App\Models\Comment;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
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
        // Obtener el usuario del perfil
        $user = User::findOrFail($user->id);

        // Obtener el último post del usuario
        $lastPost = $user->posts()->latest()->first();

        // Obtener los comentarios del usuario que sean de amigos
        $userFriends = $user->friends()->wherePivot('status', 'accepted')->pluck('friend_id')->toArray();
        $comments = Comment::whereIn('profile_user_id', $userFriends)->orderByDesc('created_at')->get();



        // Calcular la duración del post
        $duracion = $lastPost ? $lastPost->created_at->diffForHumans() : null;

        // Registrar la visita en la base de datos
        if(auth()->check() && auth()->user()->id != $user->id){
            $visitor_id = auth()->id();
            DB::table('visits')->insert([
                'user_id' => $user->id,
                'visitor_id' => $visitor_id,
                'created_at' => now(),
            ]);
        }

        $isFriend = false;

        if (Auth::check()) {
            $authUser = Auth::user();
            if ($authUser->id != $user->id) {
                $friendship = Friendship::where([
                    ['user_id', $authUser->id],
                    ['friend_id', $user->id]
                ])->orWhere([
                    ['user_id', $user->id],
                    ['friend_id', $authUser->id]
                ])->first();

                if ($friendship && $friendship->status == 'accepted') {
                    $isFriend = true;
                }
            }
        }

        $profilePicture = $user->profile_picture ? asset('storage/profile_pictures/'.$user->profile_picture) : null;

        return view('users.show', compact('user', 'isFriend', 'profilePicture', 'lastPost', 'duracion', 'comments'));
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
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|max:2048'
    ], [
        'name.required' => 'El nombre es obligatorio.',
        'name.max' => 'El nombre no puede tener más de 255 caracteres.',
        'surname.required' => 'El apellido es obligatorio.',
        'surname.max' => 'El apellido no puede tener más de 255 caracteres.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser válido.',
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'profile_picture.image' => 'El archivo debe ser una imagen.',
        'profile_picture.max' => 'La imagen no puede ser mayor a 2MB.'
    ]);

    $user->name = $request->input('name');
    $user->surname = $request->input('surname');
    $user->email = $request->input('email');

    if ($request->has('password') && $request->has('password_confirmation') && $request->input('password') != '') {
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        if ($password === $password_confirmation) {
            $user->password = Hash::make($password);
        }
    }

    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture !== 'default.jpg') {
            // Eliminar la foto anterior si existe
            Storage::delete('public/profile_pictures/'.$user->profile_picture);
        }
        $profilePicture = $request->file('profile_picture');
        $filename = $profilePicture->getClientOriginalName();
        $profilePicture->storeAs('public/profile_pictures', $filename);
        $user->profile_picture = $filename;
    }


    if ($request->has('delete_profile_picture')) {
        if ($user->profile_picture !== 'default.jpg') {
            // Eliminar foto de perfil
            Storage::delete('public/profile_pictures/'.$user->profile_picture);
            $user->profile_picture = 'default.jpg';
        }
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
            ->orWhere('surname', 'like', '%'.$request->input('q').'%')
            ->get();

        return view('users.search', ['users' => $users]);
    }
}
