@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">
        <h1>-</h1>
    </div>
    <div class="central">
        <form action="{{ route('users.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-actualizar-perfil">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}">

                <label for="name">Apellidos:</label>
                <input type="text" name="surname" id="surname" value="{{ $user->surname }}">

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}">

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password">

                <label for="password_confirmation">Confirmar contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation">

                <label for="profile_picture">Foto de perfil:</label>
                <input type="file" name="profile_picture" id="profile_picture">

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>

    </div>
    <div class="lateral-der">
        <h1>-</h1>
    </div>

</main>

@endsection
