<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }
    public function register(RegisterRequest $request){
        $user = new User();
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->country = $request->get('country');
        $user->city = $request->get('city');
        $user->birthdate = $request->get('birthdate');
        $user->genre = $request->get('genre');

        $user->save();
        Auth::login($user);

        return redirect()->route('inicio');
    }

    public function loginForm(){
        if (Auth::viaRemember()){
            return 'Bienvenido de nuevo';
        }
        else{
            if (Auth::check()){
                return redirect()->route('inicio');
            }
            else{
                return view('auth.login');
            }
        }
    }
    public function login(Request $request){
        $credenciales = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credenciales)){
            $request->session()->regenerate();
            return redirect()->route('inicio');
        }
        else{
            $error = 'Error al acceder a Tuenti.';
            return view('inicio', compact('error'));
        }
    }
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }
}
