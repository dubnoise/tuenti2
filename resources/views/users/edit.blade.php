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
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="surname">Apellidos:</label>
                <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}">
                @error('surname')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="password_confirmation">Confirmar contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="profile_picture">Foto de perfil:</label>
                <input type="file" name="profile_picture" id="profile_picture">
                @error('profile_picture')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div>
                    <input type="checkbox" name="delete_profile_picture" id="delete_profile_picture">
                    <label for="delete_profile_picture">Eliminar foto de perfil</label>
                </div>

                <input type="submit" value="Actualizar">
            </div>
        </form>


    </div>
    <div class="lateral-der">
        <h1>-</h1>
    </div>

</main>

@endsection
