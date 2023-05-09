@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">
        <div class="profile-izq">
            @if ($profilePicture)
                <img src="{{ $profilePicture }}" alt="{{ $user->profile_picture }}">
            @else
                <img src="{{ asset('storage/profile_pictures/default.jpg') }}" alt="default">
            @endif



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
                <li><b>Fecha de nacimiento:</b> {{ date('d/m/Y', strtotime($user->birthdate)) }}</li>

            </ul>
        </div>
    </div>
    <div class="central">
        <div class="nombre-perfil">
            <h3>{{ $user->name }} {{ $user->surname }}</h3>
        </div>

        <div class="mensaje-privado-perfil">
            <a href="{{ route('messages.create', 'id='.$user->id) }}">Mensaje privado</a>
        </div>

        <div class="ultimo-estado-perfil">
            @if(isset($lastPost->content))
                <div class="ultimo-estado">
                    <h3>{{ $lastPost->content }}</h3>
                    <p>{{ $duracion }}</p>
                </div>

                @if(auth()->check() && $lastPost->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $lastPost->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="eliminar-estado">
                            <input class="eliminar-estado-btn" type="submit" value="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este post?')">
                        </div>
                    </form>
                @endif
            @else
                <p>Sin estado que mostrar.</p>
            @endif
        </div>



    </div>
    <div class="lateral-der">
        <div class="container-fotos-perfil">
            <h4>Fotos</h4>
            <hr>
            @php
                $userPictures = $user->pictures()->orderBy('created_at', 'desc')->take(6)->get();
            @endphp
            <div class="album-fotos-perfil">
                @forelse ($userPictures as $picture)
                    <img src="{{ asset('storage/pictures/' . $picture->user_id . '/' . $picture->url . '.jpg') }}" alt="{{$picture->url}}">
                @empty
                    <h2>Nada</h2>
                @endforelse
            </div>
            <br>
            <hr>
            <br>
            <a href="/pictures/{{$user->id}}">Ver todas <span>({{ $user->pictures()->count() }})</span></a>

        </div>

    </div>

</main>

@endsection
