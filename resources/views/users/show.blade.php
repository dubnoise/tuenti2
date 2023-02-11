@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">
        <div class="profile-izq">
            <img src={{asset('img/blank-user.jpg')}} alt="user">
            <h3>Información</h3>
            <hr>
            <ul>
                <li><b>Nombre:</b> {{$user->name}}</li>
                <li><b>Apellidos:</b> {{$user->surname}}</li>
                <li><b>País:</b> {{$user->country}}</li>
                <li><b>Ciudad:</b> {{$user->city}}</li>
                <li><b>Sexo:</b>
                    @if ($user->genre != "")
                        {{$user->genre}}
                    @else
                        ¿?
                    @endif
                </li>
                <li><b>Fecha de nacimiento:</b> {{$user->birthdate}}</li>
            </ul>
        </div>
    </div>
    <div class="central">

    </div>
    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>



@endsection
