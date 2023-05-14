@extends('layout')

@section('titulo', 'Tuenti')

@section('contenido')

<header>
    @include('partials.header')
</header>

<main>
    <div class="lateral-izq">
        <h2>-</h2>
    </div>
    <div class="central">

        <hr>

        @if ($users->count() > 0)

            @foreach ($users as $user)
                <div class="busqueda-usuarios">

                    <div class="foto-y-datos-busqueda">
                        <a href="{{ route('users.show', $user->id) }}"><img src="{{ asset('storage/profile_pictures/'.$user->profile_picture) }}" alt="profile-image"></a>
                        <div class="datos-busqueda">
                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }} {{ $user->surname }}</a>
                            <p>País: <b>{{ $user->country }}</b></p>
                            <p>Ciudad: <b>{{ $user->city }}</b></p>
                            <p>Fecha de nacimiento: <b>{{ date('d/m/Y', strtotime($user->birthdate)) }}</b></p>
                        </div>

                    </div>

                    <div class="botones-usuarios-busqueda">
                        <a href="{{ route('messages.create', 'id='.$user->id) }}">Mensaje privado</a>

                    @if(!auth()->user()->isFriendWith($user) && !$user->hasFriendRequestFrom(auth()->user()))
                        <form action="{{ route('friendship.sendRequest', $user->id) }}" method="post">
                            @csrf
                            <button type="submit">Enviar solicitud de amistad</button>
                        </form>
                    @endif

                    @if($user->hasFriendRequestFrom(auth()->user()))
                        <form action="{{ route('friendship.cancelRequest', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancelar solicitud de amistad</button>
                        </form>
                    @endif


                    @if(auth()->user()->isFriendWith($user) && $user->id !== auth()->id())
                        <form action="{{ route('friendship.deleteFriend', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm(`¿Está seguro de que desea eliminar a {{ $user->name }} {{ $user->surname }} de la lista de amigos?`)">Eliminar amigo</button>
                        </form>
                    @endif

                    </div>
                    <hr>
                </div>

            @endforeach

        @else
            <p>No se encontraron resultados.</p>
        @endif

    </div>
    <div class="lateral-der">
        <h2>-</h2>
    </div>

</main>

@endsection


